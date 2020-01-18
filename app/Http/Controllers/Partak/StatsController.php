<?php

namespace App\Http\Controllers\Partak;

use App\Facades\Settings;
use App\Models\Buddy;
use App\Http\Controllers\Controller;
use App\Models\ExchangeStudent;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $currentSemester = Settings::get('currentSemester');

        $semester = $request->input('semester', $currentSemester);
        $semesters = Semester::all()->pluck('semester', 'semester');

        $previusSmemester = Semester::where('semester', $semester)
            ->first()
            ->previousSemester();
        $minusFourMonths = Carbon::now()->addMonths(-4);

        $activeBuddies = Buddy::where('last_login', '>', $minusFourMonths)
            ->count();

        $buddiesCounts = Buddy::withCount([
                'exchangeStudents' => function (Builder $studentQuery) use ($semester, $previusSmemester) {
                    $studentQuery->whereHas('semesters', function (Builder $query) use ($semester) {
                        $query->where('semester', $semester);
                    })->whereDoesntHave('semesters', function (Builder $query) use ($previusSmemester) {
                        $query->where('semester', $previusSmemester->semester);
                    });
                }
            ])
            ->having('exchange_students_count', '>', '0')
            ->orderBy('exchange_students_count', 'desc')
            ->get();

        $avgBuddiesPerBuddy = $buddiesCounts->map(function ($item) {
            return $item->exchange_students_count;
        })->avg();

        $arrivingStudents = ExchangeStudent::byUniqueSemester($semester)
            ->count();

        $studentsWithFilledProfile = ExchangeStudent::withFilledProfile($semester)
            ->count();

        $studentsWithBuddy = ExchangeStudent::byUniqueSemester($semester)
            ->whereHas('buddy')
            ->count();

        $studentsWithFilledProfileWithoutBuddy = ExchangeStudent::availableToPick($semester)
            ->count();

        return view('partak.stats.index', [
            'activeBuddies' => $activeBuddies,
            'arrivingStudents' => $arrivingStudents,
            'studentsWithFilledProfile' => $studentsWithFilledProfile,
            'studentsWithBuddy' => $studentsWithBuddy,
            'studentsWithFilledProfileWithoutBuddy' => $studentsWithFilledProfileWithoutBuddy,
            'buddiesCounts' => $buddiesCounts,
            'avgBuddiesPerBuddy' => $avgBuddiesPerBuddy,
            'semester' => $semester,
            'semesters' => $semesters
        ]);
    }
}
