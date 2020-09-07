<?php

/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 5.2.17
 * Time: 9:41
 */

namespace App\Http\Controllers\Partak;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Models\Accommodation;
use App\Models\Country;
use App\Models\Person;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facades\Settings;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;

class OfficeRegistrationController extends Controller
{
    public function showOfficeRegistrationDashboard()
    {

        $this->authorize('acl', 'exchangeStudents.register');
        $esnRegistered = ExchangeStudent::byUniqueSemester(Settings::get('currentSemester'))
            ->where('esn_registered', 'y')->count();
        return view('partak.users.officeRegistration.dashboard')->with(['esnRegistered' => $esnRegistered]);
    }

    public function showExchangeStudent($id)
    {
        $this->authorize('acl', 'exchangeStudents.register');
        return view('partak.users.officeRegistration.register')->with([
            'exStudent' => ExchangeStudent::with('person.user')->find($id),
            'faculties' => Faculty::getOptions(),
            'accommodations' => Accommodation::getOptions(),
        ]);
    }

    public function esnRegistration(ExchangeStudent $student)
    {
        $this->authorize('acl', 'exchangeStudents.register');

        if (request()->has('phone') && substr(request('phone'), 0, 3) === '420') {
            request()->merge(['phone' => '+' . request('phone')]);
        }

        $data = request()->validate([
            'phone' => ['sometimes', 'required', 'phone:CZ', 'unique:exchange_students'],
            'esn_card_number' => ['sometimes', 'required', 'string', 'unique:exchange_students'],
        ]);
        $data['esn_registered'] = 'y';
        $student->update($data);

        return back()->with([
            'successRegister' => true,
        ]);
    }

    public function showCreateExStudent()
    {
        $this->authorize('acl', 'exchangeStudents.add');
        $exStudent = new ExchangeStudent();
        return view('partak.users.officeRegistration.new')->with([
            'exStudent' => $exStudent,
            'faculties' => Faculty::getOptions(),
            'accommodations' => Accommodation::getOptions(),
            'countries' => Country::getOptions(),
            'diets' => Person::getAllDiets(),
        ]);
    }

    public function createExStudent(Request $request)
    {
        $this->authorize('acl', 'exchangeStudents.add');
        $this->profileValidator($request->all())->validate();
        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }
        $exStudent = ExchangeStudent::registerExStudent($data);
        $exStudent = ExchangeStudent::with('person.user')->find($exStudent->id_user);
        $exStudent->update($data);
        $exStudent->person->updateWithIssuesAndDiet($data);

        $semester = Semester::where('semester', Settings::get('currentSemester'))->first();
        $exStudent->semesters()->attach($semester->id_semester);

        if (array_key_exists('fullTime', $data) && $data['fullTime'] == 'y') {
            $exStudent->person->user->addRole('samoplatce');
        }

        return redirect()
            ->route('partak.users.exStudent.edit', ['id_user' => $exStudent->id_user]);
    }

    protected function profileValidator(array $data)
    {
        $fbProfileUrlRegex = '/^(https?:\/\/)?((www|m)\.)?(facebook|fb)(\.(com|me))\/(profile\.php\?id=[0-9]+(&[^&]*)*|(?!profile\.php\?)([a-zA-Z0-9][.]*){4,}[a-zA-Z0-9]+\/?(\?.*)?)$/';

        $validator = Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'id_country' => 'required',
            'id_faculty' => 'required',
            'id_accommodation' => 'required',
            'phone' => 'max:16',
            'age' => 'digits:4',
            'email' => 'required|max:255|email|unique:users,email',
            'esn_card_number' => 'max:12',
            'medical_issues' => 'max:255',
            'whatsapp' => ['phone:AUTO', 'nullable'],
            'facebook' => ["regex:$fbProfileUrlRegex", 'nullable'],
        ]);
        return $validator;
    }

    public function showPreregistrations($id = 1)
    {
        $this->authorize('acl', 'exchangeStudents.register');
        return view('partak.users.preregistration')->with('currentId', $id);
    }
}
