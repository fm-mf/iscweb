<?php

namespace App\Http\Controllers\Partak;

use App\Facades\Settings;
use App\Models\Buddy;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuddyResource;
use App\Models\Arrival;
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

        $studentsFromPreviousSemester = ExchangeStudent::
            whereHas('semesters', function (Builder $query) use ($semester) {
                $query->where('semester', $semester);
            })
            ->whereHas('semesters', function (Builder $query) use ($previusSmemester) {
                $query->where('semester', $previusSmemester->semester);
            })
            ->count();

        return view('partak.stats.index', [
            'activeBuddies' => $activeBuddies,
            'arrivingStudents' => $arrivingStudents,
            'studentsWithFilledProfile' => $studentsWithFilledProfile,
            'studentsWithBuddy' => $studentsWithBuddy,
            'studentsWithFilledProfileWithoutBuddy' => $studentsWithFilledProfileWithoutBuddy,
            'buddiesCounts' => $buddiesCounts,
            'avgBuddiesPerBuddy' => $avgBuddiesPerBuddy,
            'studentsFromPreviousSemester' => $studentsFromPreviousSemester,
            'semester' => $semester,
            'semesters' => $semesters
        ]);
    }

    public function showArrivals(Request $request)
    {
        $currentSemester = Settings::get('currentSemester');

        $semester = $request->input('semester', $currentSemester);
        $semesters = Semester::all()->pluck('semester', 'semester');
        $previusSmemester = Semester::where('semester', $semester)
            ->first()
            ->previousSemester();

        $arrivingStudents = ExchangeStudent::byUniqueSemester($semester)
            ->count();

        $studentsWithFilledProfile = ExchangeStudent::withFilledArrival($semester)
            ->count();

        $previousStudents = ExchangeStudent::
            whereHas('semesters', function (Builder $query) use ($semester) {
                $query->where('semester', $semester);
            })
            ->whereHas('semesters', function (Builder $query) use ($previusSmemester) {
                $query->where('semester', $previusSmemester->semester);
            })
            ->count();

        $arrivals = Arrival::select(\DB::raw('DATE(arrival) as arrival'), \DB::raw('count(*) as count'))
            ->whereHas('exchangeStudent', function (Builder $studentQuery) use ($semester, $previusSmemester) {
                $studentQuery->whereHas('semesters', function (Builder $query) use ($semester) {
                    $query->where('semester', $semester);
                })->whereDoesntHave('semesters', function (Builder $query) use ($previusSmemester) {
                    $query->where('semester', $previusSmemester->semester);
                });
            })
            ->orderBy('arrival', 'asc')
            ->groupBy(\DB::raw('DATE(arrival)'))
            ->get();

        $transports = ExchangeStudent::byUniqueSemester($semester)
            ->join('arrivals', 'exchange_students.id_user', '=', 'arrivals.id_user')
            ->join('transportation', 'arrivals.id_transportation', '=', 'transportation.id_transportation')
            ->select('transportation.transportation', \DB::raw('count(*) as count'))
            ->groupBy('transportation.transportation')
            ->orderBy('count', 'desc')
            ->get();

        $arrivalsMax = $arrivals->map(function ($arrival) {
            return $arrival->count;
        })->max();

        $transportsMax = $transports->map(function ($transport) {
            return $transport->count;
        })->max();

        return view('partak.stats.arrivals', [
            'arrivals' => $arrivals,
            'arrivalsMax' => $arrivalsMax,
            'arrivingStudents' => $arrivingStudents,
            'studentsWithFilledProfile' => $studentsWithFilledProfile,
            'previousStudents' => $previousStudents,
            'transports' => $transports,
            'transportsMax' => $transportsMax,
            'semester' => $semester,
            'semesters' => $semesters
        ]);
    }

    public function getActiveBuddies()
    {
        $minusFourMonths = Carbon::now()->addMonths(-4);

        return response()->json(
            BuddyResource::collection(Buddy::where('last_login', '>', $minusFourMonths)->get())
        );
    }

    public function getBuddies(Semester $semester)
    {
        $buddies = Buddy::withCount([
                'exchangeStudents' => function (Builder $studentQuery) use ($semester) {
                    $studentQuery->whereHas('semesters', function (Builder $query) use ($semester) {
                        $query->where('semester', $semester->semester);
                    })->whereDoesntHave('semesters', function (Builder $query) use ($semester) {
                        $query->where('semester', $semester->previousSemester()->semester);
                    });
                }
            ])
            ->having('exchange_students_count', '>', '0')
            ->orderBy('exchange_students_count', 'desc')
            ->get();

        return response()->json(
            BuddyResource::collection($buddies)
        );
    }

    public function getStudentCounts(Semester $semester)
    {
        $arrivingStudents = ExchangeStudent::byUniqueSemester($semester->semester)
            ->count();

        $studentsWithFilledProfile = ExchangeStudent::withFilledProfile($semester->semester)
            ->count();

        $studentsWithFilledArrival = ExchangeStudent::withFilledArrival($semester->semester)
            ->count();

        $studentsWithBuddy = ExchangeStudent::byUniqueSemester($semester->semester)
            ->whereHas('buddy')
            ->count();

        $studentsFromPreviousSemester = ExchangeStudent::
            whereHas('semesters', function (Builder $query) use ($semester) {
                $query->where('semester', $semester->semester);
            })
            ->whereHas('semesters', function (Builder $query) use ($semester) {
                $query->where('semester', $semester->previousSemester()->semester);
            })
            ->count();

        return response()->json([
            'arriving_students' => $arrivingStudents,
            'students_with_profile' => $studentsWithFilledProfile,
            'students_with_arrival' => $studentsWithFilledArrival,
            'students_with_buddy' => $studentsWithBuddy,
            'students_from_previous' => $studentsFromPreviousSemester,
        ]);
    }

    public function getArrivals(Semester $semester)
    {
        $arrivals = Arrival::select('arrival', \DB::raw('count(*) as count'))
            ->whereHas('exchangeStudent', function (Builder $studentQuery) use ($semester) {
                $studentQuery->whereHas('semesters', function (Builder $query) use ($semester) {
                    $query->where('semester', $semester->semester);
                })->whereDoesntHave('semesters', function (Builder $query) use ($semester) {
                    $query->where('semester', $semester->previousSemester()->semester);
                });
            })
            ->orderBy('arrival', 'asc')
            ->groupBy('arrival')
            ->get();

        $transports = ExchangeStudent::byUniqueSemester($semester->semester)
            ->join('arrivals', 'exchange_students.id_user', '=', 'arrivals.id_user')
            ->join('transportation', 'arrivals.id_transportation', '=', 'transportation.id_transportation')
            ->select('transportation.eng', \DB::raw('count(*) as count'))
            ->groupBy('transportation.eng')
            ->orderBy('count', 'desc')
            ->get();

        return response()->json([
            'dates' => $arrivals,
            'transports' => $transports
        ]);
    }
}
