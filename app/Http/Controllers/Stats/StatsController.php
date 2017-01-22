<?php

namespace App\Http\Controllers\Stats;

use App\Models\Country;
use App\Models\ExchangeStudent;
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
            'studentsWithFilledProfile' => ExchangeStudent::byUniqueSemester($currentSemester)->whereNotNull('about')->count(),
            'studentsWithBuddy' => ExchangeStudent::byUniqueSemester($currentSemester)->has('buddy')->count(),
            'studentsWithFilledProfileWithoutBuddy' => ExchangeStudent::byUniqueSemester($currentSemester)->wantBuddy()->doesntHave('buddy')->count(),
            'countriesStats' => Country::withCount(['exchangeStudent' => function($query) use ($currentSemester) {
                $query->byUniqueSemester($currentSemester);
            }])->orderBy('exchange_student_count', 'desc')->get()
        ]);
    }
}
