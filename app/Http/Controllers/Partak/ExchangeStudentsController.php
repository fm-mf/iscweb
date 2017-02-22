<?php

namespace App\Http\Controllers\Partak;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Models\Accommodation;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;

class ExchangeStudentsController extends Controller
{
    protected function profileValidator(array $data)
    {
        $validator = Validator::make($data, [
            'phone' => 'max:15',
            'age' => 'digits:4',
            'email' => 'required|max:255|email',
            'esn_card_number' => 'max:12',
            'medical_issues' => 'max:255'
        ]);
        return $validator;
    }

    public function showExchangeStudentDashboard()
    {
        $this->authorize('acl', 'exchangeStudents.view');
        return view('partak.users.exchangeSudents.dashboard');
    }

    public function showDetailExchangeStudent($id)
    {
        $this->authorize('acl', 'exchangeStudents.view');
        $exStudent = ExchangeStudent::with(['person.user', 'buddy.person.user', 'country', 'accommodation', 'faculty', 'arrival'])->find($id);
        return view('partak.users.exchangeSudents.detail')->with(['exStudent' => $exStudent,]);
    }

    public function showEditFormExchangeStudent($id)
    {
        $this->authorize('acl', 'exchangeStudents.edit');
        return view('partak.users.exchangeSudents.edit')->with([
            'exStudent' => ExchangeStudent::with('person.user')->find($id),
            'faculties' => Faculty::getOptions(),
            'accommodations' => Accommodation::getOptions(),
            'diets' => Person::getAllDiets(),
        ]);
    }

    public function submitEditFormExStudent(Request $request, $id)
    {
        $this->authorize('acl', 'exchangeStudents.edit');
        $this->profileValidator($request->all())->validate();

        $exStudent = ExchangeStudent::with('person.user')->find($id);

        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }
        if(! isset($data['esn_registered'])) $data['esn_registered'] = 'n';
        $exStudent->person->user->update($data);
        $exStudent->person->update($data);
        $exStudent->update($data);

        return back()->with(['successUpdate' => true,]);
    }

}
