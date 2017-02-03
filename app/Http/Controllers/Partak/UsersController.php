<?php

namespace App\Http\Controllers\Partak;

use App\Models\Buddy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function showBuddiesDashboard()
    {

        return view('partak.users.buddiesdashboard')->with([
            'notVerifiedBuddies' => Buddy::with('person.user')->notVerified()
        ]);
    }

    public function showBuddyDetail($id)
    {
        $buddy = Buddy::findBuddy($id);
        $myStudents = $buddy->exchangeStudents()->with('person.user')->get();

        return view('partak.users.buddy')->with([
            'buddy' => $buddy,
            'myStudents' => $myStudents
        ]);
    }
}
