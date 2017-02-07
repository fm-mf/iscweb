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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;

class OfficeRegistrationController extends Controller
{
    public function showOfficeRegistrationDashboard()
    {
        return view('partak.users.officeRegistration.dashboard');
    }

    public function showExchangeStudent($id)
    {
        $exStudent = ExchangeStudent::eagerFind($id);
        return view('partak.users.officeRegistration.register')->with([
            'exStudent' => ExchangeStudent::with('person.user')->find($id),
            'faculties' => Faculty::getOptions(),
            'accommodations' => Accommodation::getOptions(),
        ]);
    }

    public function esnRegistration($id)
    {
        $exStudent = ExchangeStudent::find($id);
        //dd($exStudent);
        $exStudent->esn_registered = 'y';
        $exStudent->save();
        return back();
    }

    public function showCreateExStudent()
    {
        $exStudent = new ExchangeStudent();
        return view('partak.users.officeRegistration.new')->with([
            'exStudent' => $exStudent,
            'faculties' => Faculty::getOptions(),
            'accommodations' => Accommodation::getOptions(),
            'countries' => Country::getOptions(),
        ]);
    }

    public function createExStudent(Request $request)
    {
        //TODO validation\
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
        $exStudent->person->update($data);
        return \Redirect::route('exStudent.edit',['id_user' => $exStudent->id_user]);
    }

    protected function profileValidator(array $data)
    {
        $validator = Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'id_country' => 'required',
            'id_faculty' => 'required',
            'id_accommodation' => 'required',
            'phone' => 'max:15',
            'age' => 'digits:4',
            'email' => 'required|max:255|email',
            'esn_card_number' => 'max:12',
            'medical_issues' => 'max:255'
        ]);
        return $validator;
    }

    public function showPreregistrations($id = 1)
    {
        return view('partak.users.preregistration')->with('currentId', $id);
    }

}