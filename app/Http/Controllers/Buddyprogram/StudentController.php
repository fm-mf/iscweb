<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Events\ExchangeStudentPicked;
use App\Exceptions\AlreadyHasBuddyException;
use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Facades\Settings ;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function showProfile(ExchangeStudent $exchangeStudent)
    {
        $me = Buddy::find(Auth::id());

        if (Settings::isDatabaseClosed() && $exchangeStudent->id_buddy != Auth::id()) {
            return redirect(action('Buddyprogram\ListingController@listExchangeStudents'));
        }

        if ($exchangeStudent == null) {
            $errors['accessDenied'] = __('buddy-program.access-denied');
            return redirect(action('Buddyprogram\ListingController@listExchangeStudents'))->withErrors($errors);
        }
        if ($exchangeStudent->id_buddy != Auth::id() && !$exchangeStudent->isAvailableToPick()) {
            $errors['accessDenied'] = __('buddy-program.access-denied');
            return redirect(action('Buddyprogram\ListingController@listExchangeStudents'))->withErrors($errors);
        }

        $canChoose = $me->pickedStudentsToday() < Settings::get('limitPerDay', 1);

        $dailyLimit = Settings::get('limitPerDay');

        return view('buddyprogram.profile')->with([
            'exchangeStudent' => $exchangeStudent,
            'avatar' => $exchangeStudent->person->avatar(),
            'canChoose' => $canChoose,
            'limit' => $dailyLimit,
        ]);
    }

    public function assignBuddy(ExchangeStudent $exchangeStudent)
    {
        if (Settings::isDatabaseClosed()) {
            return redirect(action('Buddyprogram\ListingController@listExchangeStudents'));
        }

        $me = Buddy::find(Auth::id());
        $limitPerDay = Settings::get('limitPerDay', 1);
        if ($me->pickedStudentsToday() >= $limitPerDay) {
            $errors['limitReached'] = __('buddy-program.buddy-limit-reached', ['limit' => $limitPerDay]);
            return back()->withErrors($errors);
        }

        try {
            DB::transaction(function () use ($exchangeStudent, $me) {
                if ($exchangeStudent->id_buddy != null) {
                    throw new AlreadyHasBuddyException();
                }
                $exchangeStudent->id_buddy = $me->id_user;
                $exchangeStudent->buddy_timestamp = Carbon::now();
                $exchangeStudent->save();
            });
        } catch (AlreadyHasBuddyException $e) {
            $errors['alreadyHasABuddy'] = __('buddy-program.already-has-buddy');
        }

        if (isset($errors)) {
            return back()->withErrors($errors);
        } else {
            event(new ExchangeStudentPicked($me, $exchangeStudent));
            return back()->with('success', true);
        }
    }
}
