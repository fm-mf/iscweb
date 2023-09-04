<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Facades\Settings;
use App\Models\Buddy;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DegreeStudent;
use App\Models\ExchangeStudent;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ListingController extends Controller
{
    public function showClosed()
    {
        $currentSemester = Semester::getCurrentSemester()->semester;

        $isDegreeBuddy = auth()->user()->isDegreeBuddy();

        $countriesCnt = Country::withCount([($isDegreeBuddy ? 'degreeStudents' : 'exchangeStudents') => function ($query) use ($currentSemester) {
            $query->byUniqueSemester($currentSemester);
        }])->having(($isDegreeBuddy ? 'degree_students_count' : 'exchange_students_count'), '>', 0)
            ->count();

        $studentsCnt = $isDegreeBuddy
            ? DegreeStudent::query()
            : ExchangeStudent::query();
        $studentsCnt = $studentsCnt->byUniqueSemester($currentSemester)->count();

        return view('buddyprogram.closed')->with([
            'semester' => Semester::getCurrentSemester(),
            'buddyDbFrom' => $this->dbOpenFrom(),
            'countriesCnt' => $countriesCnt,
            'incomingStudentsCnt' => $studentsCnt,
        ]);
    }

    public function listExchangeStudents()
    {
        if ($this->dbIsClosed()) {
            return $this->showClosed();
        }

        return view('buddyprogram.list');
    }

    public function listMyStudents()
    {
        $me = Buddy::find(Auth::user()->id_user);

        if ($me->degree_buddy) {
            $myStudents = $me->degreeStudents();
        } else {
            $myStudents = $me->exchangeStudents();
        }

        $myStudents = $myStudents->with('person.user')->bySemester(Settings::get('currentSemester'))->get();

        return view('buddyprogram.mystudents')->with([
                'myStudents' => $myStudents
            ]);
    }

    private function dbOpenFrom(): Carbon
    {
        return auth()->user()->isDegreeBuddy()
            ? Settings::degreeBuddyDbFrom()
            : Settings::buddyDbFrom();
    }

    private function dbIsOpen(): bool
    {
        return auth()->user()->isDegreeBuddy()
            ? Settings::isDegreeDatabaseOpen()
            : Settings::isDatabaseOpen();
    }

    private function dbIsClosed(): bool
    {
        return !$this->dbIsOpen();
    }
}
