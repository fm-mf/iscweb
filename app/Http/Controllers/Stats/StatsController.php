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
        return view('stats.stats')->with([
            'students' => ExchangeStudent::byUniqueSemester($currentSemester)->count(),
            'studentsWithFilledProfile' => ExchangeStudent::byUniqueSemester($currentSemester)->whereNotNull('about')->wantBuddy()->count(),
            'studentsWithBuddy' => ExchangeStudent::byUniqueSemester($currentSemester)->has('buddy')->whereNotNull('about')->count(),
            'studentsWithFilledProfileWithoutBuddy' => ExchangeStudent::byUniqueSemester($currentSemester)->wantBuddy()->doesntHave('buddy')->whereNotNull('about')->count(),
            'countriesStats' => Country::withCount(['exchangeStudent' => function($query) use ($currentSemester) {
                $query->byUniqueSemester($currentSemester);
            }])->orderBy('exchange_student_count', 'desc')->get()
        ]);
    }

    public function showOwTripsStatistics()
    {
        $trips = Trip::with('event')->get();
        return view('stats.owTripsStats')->with(['trips' => $trips]);
    }

}
