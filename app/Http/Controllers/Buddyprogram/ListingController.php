<?php

namespace App\Http\Controllers\Buddyprogram;

use App\DbConfig\DbConfig;
use App\Models\Accommodation;
use App\Models\Buddy;
use App\Models\Country;
use App\Models\ExchangeStudent;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JavaScript;

class ListingController extends Controller
{
    public function index()
    {
        $arrivalDates = [];
        $firstArrivalDay = Carbon::createFromDate(2017, 2, 1);
        for ($dayOffset = 0; $dayOffset < 15; ++$dayOffset) {
            $day = $firstArrivalDay->copy()->addDays($dayOffset);
            $arrivalDates[] = $day->format('d M Y');
        }

        JavaScript::put([
            'jscountries' => Country::allWithStudents('fall2016'),
            'jsfaculties' => Faculty::all(),
            'jsaccommodation' => Accommodation::all(),
            'jsdays' => $arrivalDates
        ]);

        return view('buddyprogram.index')->with([
            'countries' => Country::allWithStudents('fall2016'),
            'faculties' => Faculty::all(),
            'accommodations' => Accommodation::all(),
            'days' => $arrivalDates

        ]);
    }

    public function listExchangeStudents()
    {
        $firstArrivalDay = Carbon::createFromDate(2017, 2, 1);
        for ($dayOffset = 0; $dayOffset < 15; ++$dayOffset) {
            $day = $firstArrivalDay->copy()->addDays($dayOffset);
            $arrivalDates[] = $day->format('d M Y');
        }

        JavaScript::put([
            'jscountries' => Country::allWithStudents('fall2016'),
            'jsfaculties' => Faculty::all(),
            'jsaccommodation' => Accommodation::all(),
            'jsdays' => $arrivalDates
        ]);

        return view('buddyprogram.list');
    }

    public function showMyStudents(DbConfig $config)
    {
        $config->set('currentSemester', 'mySemester');
        $config->push('new', 'newValue');
        dd($config->get('new', 'test'));
        $me = Buddy::find(\Auth::user()->id_user);

        $myStudents = $me->exchangeStudents()->with('person.user')->get();

        return view('buddyprogram.mystudents')->with([
                'myStudents' => $myStudents
            ]);
    }
}
