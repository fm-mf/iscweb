<?php

namespace App\Http\Controllers\Partak;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected function profileValidator(array $data)
    {
        $validator = Validator::make($data, [
            'phone' => 'max:15',
            'age' => 'digits:4',
            'email' => 'required|max:255|email',
        ]);
        return $validator;
    }

    public function showBuddiesDashboard()
    {

        return view('partak.users.buddies.buddiesdashboard')->with([
            'notVerifiedBuddies' => Buddy::with('person.user')->notVerified()
        ]);
    }

    public function showBuddyDetail($id)
    {
        $buddy = Buddy::findBuddy($id);
        $semester = Settings::get('currentSemester');
        $myStudents = $buddy->exchangeStudents()->bySemester($semester)->with('person.user')->get();

        return view('partak.users.buddies.buddy')->with([
            'buddy' => $buddy,
            'myStudents' => $myStudents,
            'currentSemester' => $semester
        ]);
    }

    public function removeExStudentFromBuddy($id_buddy, $id_exStudent)
    {
        $exStudent = ExchangeStudent::find($id_exStudent);
        $exStudent->removeBuddy();
        $removeSuccess = 'Buddy for exchange student with name '. $exStudent->person->first_name .' '. $exStudent->person->last_name .' was removed.';
        return back()->with(['removeSuccess' => $removeSuccess]);
    }

    public function showEditFormBuddy($id)
    {
        return view('partak.users.buddies.buddiesedit')->with([
            'buddy' => Buddy::with('person.user')->find($id),
            'faculties' => Faculty::getOptions()
        ]);
    }



    public function submitEditFormBuddy(Request $request, $id)
    {


        $this->profileValidator($request->all())->validate();

        $buddy = Buddy::with('person.user')->find($id);

        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }
        $buddy->person->user->update($data);
        $buddy->person->update($data);
        $buddy->update($data);

        return back()->with(['successUpdate' => true,]);
    }
    

}
