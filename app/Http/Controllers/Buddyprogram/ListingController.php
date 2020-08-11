<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Facades\Settings;
use App\Models\Buddy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ListingController extends Controller
{
    public function __construct()
    {
        app()->setLocale('cs');
        setlocale(LC_ALL, 'cs_CZ.UTF-8'); // for Carbon formatLocalized method
    }

    public function showClosed()
    {
        $currentSemester = Settings::get('currentSemester');
        $buddyDbFrom = Settings::get('buddyDbFrom');
        $semester = substr($currentSemester, 0, -4);
        $currYear = intval(substr($currentSemester, -4));
        $season = $semester == "fall" ? "zimní" : "letní";
        $schoolYear = $semester == "fall" 
            ? $currYear . "/" . ($currYear + 1) 
            : ($currYear - 1) . "/" . $currYear;

        return view('buddyprogram.closed')->with([
            'schoolYear' => $schoolYear,
            'season' => $season,
            'buddyDbFrom' => $buddyDbFrom,
        ]);
    }

    public function listExchangeStudents()
    {
        $curr = Carbon::now();
        $timeStr = Settings::get('buddyDbFrom') . " " . Settings::get('buddyDbFromTime');
        $timeStr = str_replace('/', '-', $timeStr);
        $timeInDb = Carbon::parse($timeStr);
        if ($curr->lessThan($timeInDb)) {
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
