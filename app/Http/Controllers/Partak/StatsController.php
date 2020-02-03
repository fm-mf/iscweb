<?php

namespace App\Http\Controllers\Partak;

use App\Facades\Settings;
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
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;

class StatsController extends Controller
{
    public function showIndex()
    {
        $this->authorize('acl', 'stats.view');
        
        $semester = Settings::get('currentSemester');

        return view('partak.stats.index', ['semester' => $semester]);
    }

    public function getActiveBuddies()
    {
        $this->authorize('acl', 'stats.view');

        return response()->json(
            BuddyResource::collection($this->loadActiveBuddies()->get())
        );
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

        return response()->json(
            BuddyResource::collection($buddies)
        );
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

        $buddies = Buddy::whereHas(
            'exchangeStudents',
            function (Builder $studentQuery) use ($semester) {
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
        )
        ->count();

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
            'buddies' => $buddies
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
        $this->authorize('acl', 'stats.export');

        $students = ExchangeStudent::byUniqueSemester($semester->semester)
            ->join('countries', 'exchange_students.id_country', '=', 'countries.id_country')
            ->where('wants_present', '=', 'y')
            ->orderBy('countries.full_name', 'asc')
            ->get();

        $excel = Excel::create(
            "{$semester->semester}_ce_candidates",
            function (LaravelExcelWriter $excel) use ($students) {
                $excel->sheet('Participants', function ($sheet) use ($students) {
                    $sheet->setFreeze('A2');
                    $sheet->loadView('partak.stats.ceExport', [ 'students' => $students ]);
                });
            }
        );

        return $excel->download('xls');
    }

    public function exportActiveBuddies(Request $request)
    {
        $this->authorize('acl', 'stats.export');

        $months = (int)$request->input('months', 4);
        if (!$months || $months < 0) {
            $months = 4;
        }

        $buddies = $this->loadActiveBuddies($months)
            ->get();
            
        $now = Carbon::now();
        $excel = Excel::create(
            "{$now->year}-{$now->month}-{$now->day}-active-buddies",
            function (LaravelExcelWriter $excel) use ($buddies) {
                $excel->sheet('Participants', function ($sheet) use ($buddies) {
                    $sheet->setFreeze('A2');
                    $sheet->loadView('partak.stats.activeBuddiesExport', [ 'buddies' => $buddies ]);
                });
            }
        );

        return $excel->download('xls');
    }

    private function loadActiveBuddies($months = 4)
    {
        return Buddy::where('last_login', '>', Carbon::now()->addMonths(-$months));
    }
}
