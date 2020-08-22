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
use App\Models\Receipt;
use Illuminate\Support\Facades\Validator;
use Session;

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

        // TODO: Somehow make this universal
        $receipt = null;
        if (Session::has('receipt')) {
            $receipt = Receipt::find(Session::get('receipt'));
            $receipt = $receipt !== null ? view('partak.receipt')->with([
                'receipt' => $receipt,
                'esn_card' => true
            ]) : null;
        }

        return view('partak.users.officeRegistration.register')->with([
            'exStudent' => ExchangeStudent::with('person.user')->find($id),
            'faculties' => Faculty::getOptions(),
            'accommodations' => Accommodation::getOptions(),
            'receipt' => $receipt
        ]);
    }

    public function esnRegistration($id)
    {
        $this->authorize('acl', 'exchangeStudents.register');

        $exStudent = ExchangeStudent::find($id);

        $this->registrationValidator([
            'phone' => $exStudent->phone,
            'esn_card_number' => $exStudent->esn_card_number
        ])->validate();

        $receipt = new Receipt([
            'created_by' => auth()->id(),
            'subject' => 'ESN Membership',
            // TODO: Configurable amount
            'amount' => 500
        ]);
        $receipt->save();

        $exStudent->esn_registered = 'y';
        $exStudent->esn_receipt_id = $receipt->id_receipt;

        $exStudent->save();

        return back()->with(['receipt' => $receipt->id_receipt]);
    }

    public function esnRegistrationNotPreregistered($id, $phone, $esnCard)
    {
        $this->authorize('acl', 'exchangeStudents.register');
        $this->registrationValidator(['phone' => $phone, 'esn_card_number' => $esnCard])->validate();
        $exStudent = ExchangeStudent::find($id);
        $exStudent->esn_registered = 'y';
        $exStudent->esn_card_number = $esnCard;
        $exStudent->phone = $phone;
        $exStudent->save();
        return back();
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

    protected function registrationValidator(array $data)
    {
        $validator = Validator::make($data, [
            'phone' => ['required', 'max:16',],
            'esn_card_number' => ['required', 'max:12',],
        ]);
        return $validator;
    }

    public function showPreregistrations($id = 1)
    {
        $this->authorize('acl', 'exchangeStudents.register');
        return view('partak.users.preregistration')->with('currentId', $id);
    }
}
