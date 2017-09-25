<?php

namespace App\Http\Controllers\Stats;

use App\Models\Country;
use App\Models\ExchangeStudent;
use App\Models\Trip;
use App\Settings\Facade as Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{

    public function showStatistics()
    {
        $currentSemester = Settings::get('currentSemester');
        $countriesStates = Country::withCount(['exchangeStudent' => function($query) use ($currentSemester) {
            $query->byUniqueSemester($currentSemester);
        }])->having('exchange_student_count', '>', 0)
            ->orderBy('exchange_student_count', 'desc')->get();
        return view('stats.stats')->with([
            'students' => ExchangeStudent::byUniqueSemester($currentSemester)->count(),
            'studentsWithFilledProfile' => ExchangeStudent::byUniqueSemester($currentSemester)->whereNotNull('about')->wantBuddy()->count(),
            'studentsWithBuddy' => ExchangeStudent::byUniqueSemester($currentSemester)->has('buddy')->whereNotNull('about')->count(),
            'studentsWithFilledProfileWithoutBuddy' => ExchangeStudent::byUniqueSemester($currentSemester)->wantBuddy()->doesntHave('buddy')->whereNotNull('about')->count(),
            'countriesStats' => $countriesStates,
            'countriesCount' => $countriesStates->count(),
        ]);
    }

    public function showOwTripsStatistics()
    {
        $trips = Trip::with( 'event')
                ->whereHas('event', function ($query) {
                    $query->where('datetime_from', '>', Carbon::now('Europe/Prague'))
                            ->where('registration_from', '<=', Carbon::now('Europe/Prague'))
                            ->whereIn('type', array('exchange', 'ex+buddy'));
                })->get();
        return view('stats.owTripsStats')->with(['trips' => $trips]);
    }

}
