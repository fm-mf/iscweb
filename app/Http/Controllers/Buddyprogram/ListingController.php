<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Facades\Settings;
use App\Models\Buddy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ListingController extends Controller
{
    public function showClosed()
    {
        $currentSemester = Settings::get('currentSemester');
        $buddyDbFrom = Carbon::parse(Settings::get('buddyDbFrom'));
        $semester = substr($currentSemester, 0, -4);
        $currYear = intval(substr($currentSemester, -4));
        $academicTerm = $semester === "fall" ? __('web.term-winter') : __('web.term-summer');
        $academicYear = $semester === "fall"
            ? $currYear . "/" . ($currYear + 1)
            : ($currYear - 1) . "/" . $currYear;

        return view('buddyprogram.closed')->with([
            'academicTerm' => $academicTerm,
            'academicYear' => $academicYear,
            'buddyDbFrom' => $buddyDbFrom,
        ]);
    }

    public function listExchangeStudents()
    {
        if (Settings::isDatabaseClosed()) {
            return $this->showClosed();
        }

        return view('buddyprogram.list');
    }

    public function listMyStudents()
    {
        $me = Buddy::find(Auth::user()->id_user);

        $myStudents = $me->exchangeStudents()->with('person.user')->bySemester(Settings::get('currentSemester'))->get();

        return view('buddyprogram.mystudents')->with([
                'myStudents' => $myStudents
            ]);
    }
}
