<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Exceptions\AlreadyHasBuddyException;
use App\Models\Buddy;
use App\Models\ExchangeStudent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    private $me;
    private $dailyLimit = 2;

    public function __construct()
    {
        $this->me = Buddy::find(\Auth::user()->id_user);
    }

    public function showProfile($exchangeStudentId)
    {
        $exchangeStudent = ExchangeStudent::eagerFind($exchangeStudentId);
        $avatar = $exchangeStudent->person->user->avatar;
        if (!$avatar) {
            // todo: default avatar
        }

        return view('buddyprogram.profile')->with([
            'exchangeStudent' => $exchangeStudent,
            'avatar' => $avatar,
            'casChoose' => $this->me->pickedStudentsToday() <= $this->dailyLimit
        ]);
    }

    public function assignBuddy($exchangeStudentId)
    {
        if ($this->me->pickedStudentsToday() <= $this->canPickStudents) {
            $errors['limitReached'] = 'Dosažen denní limit vybraných zahraničních studentů (' . $this->dailyLimit . ')';
        }

        try {
            DB::transaction(function () use ($exchangeStudentId) {
                $exchangeStudent = ExchangeStudent::find($exchangeStudentId);
                if (!$exchangeStudent) {
                    throw new ModelNotFoundException();
                }
                if ($exchangeStudent->id_buddy != null) {
                    throw new AlreadyHasBuddyException();
                }

                $exchangeStudent->id_buddy = $this->me->id_user;
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
