<?php

namespace App\Http\Controllers\Partak;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;

class UsersController extends Controller
{
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
}
