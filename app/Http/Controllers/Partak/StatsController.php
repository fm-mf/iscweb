<?php

namespace App\Http\Controllers\Partak;

use App\Exports\ActiveBuddiesExport;
use App\Exports\CECandidatesExport;
use App\Facades\Settings;
use App\Http\Resources\FacultyStatResource;
use App\Models\Accommodation;
use App\Models\Buddy;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuddyResource;
use App\Http\Resources\TransportationResource;
use App\Models\Arrival;
use App\Models\ExchangeStudent;
use App\Models\Faculty;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function showIndex()
    {
        $this->authorize('acl', 'stats.view');

        $semester = Settings::get('currentSemester');

        return view('partak.stats.index', ['semester' => $semester]);
    }

    public function getBuddies(Semester $semester)
    {
        $this->authorize('acl', 'stats.view');

        $buddies = Buddy::withCount([
                'exchangeStudents' => function (Builder $studentQuery) use ($semester) {
                    $previousSemester = $semester->optionalPreviousSemester();
                    $studentQuery = $studentQuery->whereHas('semesters', function (Builder $query) use ($semester) {
                        $query->where('semester', $semester->semester);
                    });
                    if ($previousSemester) {
                        $studentQuery = $studentQuery->whereDoesntHave(
                            'semesters',
                            function (Builder $query) use ($previousSemester) {
                                $query->where('semester', $previousSemester->semester);
                            }
                        );
                    }
                    return $studentQuery;
                }
            ])
            ->having('exchange_students_count', '>', '0')
            ->orderBy('exchange_students_count', 'desc')
            ->limit(15)
            ->get();

        $byFaculty = Faculty::withCount([
            'buddies as count' => function (Builder $query) use ($semester) {
                return $query->withStudentsInSemester($semester);
            }
        ])
            ->orderBy('count', 'desc')
            ->having('count', '>', 0)
            ->get();

        return response()->json([
            'list' => BuddyResource::collection($buddies),
            'by_faculty' => FacultyStatResource::collection($byFaculty),
        ]);
    }

    public function getStudentCounts(Semester $semester)
    {
        $this->authorize('acl', 'stats.view');

        $arrivingStudents = ExchangeStudent::byUniqueSemester($semester->semester)
            ->count();

        $studentsWithFilledProfile = ExchangeStudent::withFilledProfile($semester->semester)
            ->count();

        $studentsWithFilledArrival = ExchangeStudent::withFilledArrival($semester->semester)
            ->count();

        $studentsWithBuddy = ExchangeStudent::byUniqueSemester($semester->semester)
            ->whereHas('buddy')
            ->count();

        $studentsWithEsnCard = ExchangeStudent::byUniqueSemester($semester->semester)
            ->esnRegistered()
            ->count();

        $buddiesCnt = Buddy::withStudentsInSemester($semester)->count();

        $buddiesActiveByLoginCnt = Buddy::recentlyActive()->count();

        $previouSemester = $semester->optionalPreviousSemester();
        $studentsFromPreviousSemester = 0;

        if ($previouSemester) {
            $studentsFromPreviousSemester = ExchangeStudent::
                whereHas('semesters', function (Builder $query) use ($semester) {
                    $query->where('semester', $semester->semester);
                })
                ->whereHas('semesters', function (Builder $query) use ($previouSemester) {
                    $query->where('semester', $previouSemester->semester);
                })
                ->count();
        }

        return response()->json([
            'arriving_students' => $arrivingStudents,
            'students_with_profile' => $studentsWithFilledProfile,
            'students_with_arrival' => $studentsWithFilledArrival,
            'students_with_buddy' => $studentsWithBuddy,
            'students_from_previous' => $studentsFromPreviousSemester,
            'students_with_esncard' => $studentsWithEsnCard,
            'total_buddies' => $buddiesCnt,
            'active_buddies' => $buddiesActiveByLoginCnt,
        ]);
    }

    public function getArrivals(Semester $semester)
    {
        $this->authorize('acl', 'stats.view');

        $arrivals = Arrival::select('arrival', \DB::raw('count(*) as count'))
            ->whereHas('exchangeStudent', function (Builder $studentQuery) use ($semester) {
                $previousSemester = $semester->optionalPreviousSemester();
                $studentQuery = $studentQuery->whereHas('semesters', function (Builder $query) use ($semester) {
                    $query->where('semester', $semester->semester);
                });
                if ($previousSemester) {
                    $studentQuery = $studentQuery->whereDoesntHave(
                        'semesters',
                        function (Builder $query) use ($previousSemester) {
                            $query->where('semester', $previousSemester->semester);
                        }
                    );
                }
                return $studentQuery;
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
            'transports' => TransportationResource::collection($transports)
        ]);
    }

    public function getStudents(Semester $semester, Request $request)
    {
        $this->authorize('acl', 'stats.view');

        $facultyAbbrevation = $request->input('faculty');

        $faculty = Faculty::getFacultyFromAbbreviation($facultyAbbrevation);

        $currentStudents = ExchangeStudent::byUniqueSemester($semester->semester);
        if ($faculty) {
            $currentStudents = $currentStudents
                ->where('exchange_students.id_faculty', $faculty->id_faculty);
        }

        $faculties = (clone $currentStudents)
            ->join('faculties', 'exchange_students.id_faculty', '=', 'faculties.id_faculty')
            ->select('faculties.abbreviation as faculty', \DB::raw('count(*) as count'))
            ->orderBy('count', 'desc')
            ->groupBy('faculties.abbreviation')
            ->get();

        $genders = (clone $currentStudents)
            ->join('people', 'exchange_students.id_user', '=', 'people.id_user')
            ->select('people.sex', \DB::raw('count(*) as count'))
            ->orderBy('count', 'desc')
            ->groupBy('people.sex')
            ->get();

        $accommodations = (clone $currentStudents)
            ->join('accommodation', 'exchange_students.id_accommodation', 'accommodation.id_accommodation')
            ->select('full_name', DB::raw('count(*) as count'))
            ->where('accommodation.id_accommodation' ,'!=', Accommodation::DEFAULT_ID)
            ->orderBy('count', 'desc')
            ->groupBy('full_name')
            ->get();

        $withAccommodation = $accommodations->sum(function ($accommodation) {
            return $accommodation->count;
        });

        $withWhatsapp = (clone $currentStudents)
            ->whereNotNull('whatsapp')
            ->where('whatsapp', '!=', '')
            ->count();

        $withFb = (clone $currentStudents)
            ->whereNotNull('facebook')
            ->where('facebook', '!=', '')
            ->count();

        $withPhoto = (clone $currentStudents)
            ->whereHas('person', function ($query) {
                $query->whereNotNull('avatar');
            })
            ->count();

        $withAbout = (clone $currentStudents)
            ->whereNotNull('about')
            ->where('about', '!=', '')
            ->count();

        return response()->json([
            'by_faculty' => $faculties,
            'by_gender' => $genders,
            'by_accommodation' => $accommodations,
            'with_accommodation' => $withAccommodation,
            'with_whatsapp' => $withWhatsapp,
            'with_facebook' => $withFb,
            'with_photo' => $withPhoto,
            'with_about' => $withAbout
        ]);
    }

    public function getSemesters()
    {
        $semesters = Semester::all()->pluck('semester')
            ->map(function ($semester) {
                $matches = null;
                preg_match('/(fall|spring)([0-9]{4})/', $semester, $matches);
                return $matches;
            })
            ->filter(function ($matches) {
                return $matches;
            })
            ->map(function ($matches) {
                return [
                    'id' => $matches[0],
                    'name' => "{$matches[2]} " . \ucfirst($matches[1]),
                    'year' => $matches[2],
                    'semester' => $matches[1]
                ];
            })
            ->values();

        return response()->json($semesters);
    }

    public function exportCultureEveningCandidates(Semester $semester)
    {
        $this->authorize('acl', 'stats.export_ce');

        $students = ExchangeStudent::byUniqueSemester($semester->semester)
            ->join('countries', 'exchange_students.id_country', '=', 'countries.id_country')
            ->where('wants_present', '=', 'y')
            ->orderBy('countries.full_name')
            ->get();

        return new CECandidatesExport($students, $semester);
    }

    public function exportActiveBuddies()
    {
        $this->authorize('acl', 'stats.export_buddy');

        $months = (int) request('months', Buddy::DEFAULT_ACTIVITY_LIMIT_MONTHS);
        if (!$months || $months < 0) {
            $months = Buddy::DEFAULT_ACTIVITY_LIMIT_MONTHS;
        }

        $buddies = Buddy::verified()
            ->subscribed()
            ->recentlyActive(Carbon::now()->subMonths($months))->get();

        return (new ActiveBuddiesExport($buddies))
            ->withFileNameSuffix($months . ($months == 1 ? 'month' : 'months'));
    }

    public function exportBuddieWithStudents(Semester $semester)
    {
        $this->authorize('acl', 'stats.export_buddy');

        $buddies = Buddy::withStudentsInSemester($semester)
            ->subscribed()
            ->get();

        return (new ActiveBuddiesExport($buddies))
            ->withFileNameSuffix($semester->semester);
    }
}
