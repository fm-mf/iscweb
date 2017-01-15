<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Exceptions\AlreadyHasBuddyException;
use App\Models\Buddy;
use App\Models\ExchangeStudent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Settings\Facade as Settings;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function showProfile($exchangeStudentId)
    {
        $me = Buddy::find(Auth::id());
        $exchangeStudent = ExchangeStudent::eagerFind($exchangeStudentId);
        $avatar = $exchangeStudent->person->user->avatar;
        if (!$avatar) {
            // todo: default avatar
        }

        $canChoose = $me->pickedStudentsToday() <= Settings::get('limitPerDay', 1);

        return view('buddyprogram.profile')->with([
            'exchangeStudent' => $exchangeStudent,
            'avatar' => $avatar,
            'casChoose' => $canChoose
        ]);
    }

    public function assignBuddy($exchangeStudentId)
    {
        $me = Buddy::find(Auth::id());
        if ($me->pickedStudentsToday() <= Settings::get('limitPerDay', 1)) {
            $errors['limitReached'] = 'Dosažen denní limit vybraných zahraničních studentů (' . Settings::get('limitPerDay', 1) . ')';
            return back()->withErrors($errors);
        }

        try {
            DB::transaction(function () use ($exchangeStudentId, $me) {
                $exchangeStudent = ExchangeStudent::find($exchangeStudentId);
                if (!$exchangeStudent) {
                    throw new ModelNotFoundException();
                }
                if ($exchangeStudent->id_buddy != null) {
                    throw new AlreadyHasBuddyException();
                }

                $exchangeStudent->id_buddy = $me->id_user;
                $exchangeStudent->buddy_timestamp = Carbon::now();
                $exchangeStudent->save();
            });
        } catch (ModelNotFoundException $e) {
            $errors['notFound'] = 'Student již není v naší databázi';
        } catch (AlreadyHasBuddyException $e) {
            $errors['alreadyHasABuddy'] = 'Student již má buddyho';
        }

        if ($errors) {
            return back()->withErrors($errors);
        } else {
            return back()->with('success', true);
        }
    }
}
