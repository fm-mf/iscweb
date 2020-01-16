<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Models\Arrival;
use App\Facades\Settings ;
use App\Models\Accommodation;
use App\Models\Buddy;
use App\Models\Country;
use App\Models\ExchangeStudent;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class ListingController extends Controller
{
    public function __construct()
    {
        app()->setLocale('cs');
        setlocale(LC_ALL, 'cs_CZ.UTF-8'); // for Carbon formatLocalized method
    }

    public function showClosed()
    {
        return view('buddyprogram.closed');
    }

    public function listExchangeStudents()
    {
        if (!Settings::get('isDatabaseOpen')) {
            return $this->showClosed();
        }

        $currentSemester = Settings::get('currentSemester');
        $arrivalDates = Arrival::withStudents($currentSemester)->select(DB::raw('DATE(`arrival`) AS `arrival`'))->distinct()->pluck('arrival');
        $arrivalDatesFormated = array();
        for($i = 0; $i < count($arrivalDates); $i++) {
            $arrivalDatesFormated[] = [
                'formatted' => Carbon::parse($arrivalDates[$i])->format('j. n. Y'),
                'date' => Carbon::parse($arrivalDates[$i])->format('Y-m-d')
            ];
        }

        JavaScript::put([
            'jscountries' => Country::withStudents($currentSemester)->get(),
            'jsfaculties' => Faculty::withStudents($currentSemester)->get(),
            'jsaccommodation' => Accommodation::withStudents($currentSemester)->get(),
            'jsdays' => $arrivalDatesFormated,
        ]);

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
