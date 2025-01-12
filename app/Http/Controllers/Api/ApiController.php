<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ExchangeStudentResource;
use App\Http\Resources\PreregistrationStudentCollection;
use App\Models\Accommodation;
use App\Models\Arrival;
use App\Models\Country;
use App\Models\DegreeStudent;
use App\Models\ExchangeStudent;
use App\Models\Faculty;
use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Facades\Settings ;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    const ORDER_ALIAS = [
        'name' => 'people.first_name',
        'country' => 'countries.full_name',
        'arrival' => 'arrivals.arrival',
        'faculty' => 'faculties.abbreviation',
        'school' => 'school',
        'accommodation' => 'accommodation.full_name'
    ];

    const NULLABLE_ORDER_FIELDS = [
        'arrival',
        'school',
    ];

    const FILTER_ALIAS = [
        'countries' => 'exchange_students.id_country',
        'accommodation' => 'exchange_students.id_accommodation',
        'faculties' => 'exchange_students.id_faculty'
    ];

    const DEFAULT_PREREGISTRATION_LIMIT = 10;

    public function load(Request $request)
    {
        if (Settings::isDatabaseClosed()) {
            return response()->json([]);
        }

        $page = $request->page;
        if ($page > 1) {
            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });
        }

        if (auth()->user()->isDegreeBuddy()) {
            $students = DegreeStudent::withAll();
        } else {
            $students = ExchangeStudent::withAll();
        }

        $students
            ->joinAll()
            ->availableToPick(Settings::get('currentSemester'))
            ->select('exchange_students.*');

        $sort = $request->sortBy;
        if ($sort && $sort['field'] && $sort['order']) {
            $field = $sort['field'];
            $order = $sort['order'];

            if ($order !== 'desc') {
                $order = 'asc';
            }

            if (isset(self::ORDER_ALIAS[$field])) {
                if (in_array($field, self::NULLABLE_ORDER_FIELDS)) {
                    $students->orderByRaw('ISNULL(' . DB::getQueryGrammar()->wrap(self::ORDER_ALIAS[$field]) . ') ASC');
                }

                $students->orderBy(self::ORDER_ALIAS[$field], $order);
            }
        }

        // If you can do better, please rewrite this
        if (is_array($request->filters)) {
            foreach ($request->filters as $filter => $values) {
                if ($values && is_array($values)) {
                    if ($filter === 'arrivals') {
                        $students->where(function($q) use ($values) {
                            foreach ($values as $value) {
                                if (preg_match("/^[1-9][0-9]{3}-[0-9]{2}-[0-9]{2}$/", $value)) {
                                    $q->orWhere('arrivals.arrival', 'LIKE', "$value%");
                                }
                            }
                        });
                    } elseif (isset(self::FILTER_ALIAS[$filter])) {
                        $students->whereIn(self::FILTER_ALIAS[$filter], $values);
                    }
                }
            }
        }

        return ExchangeStudentResource::collection($students->paginate(50));
    }

    public function loadFilterOptions()
    {
        if (Settings::isDatabaseClosed()) {
            return response()->json([]);
        }

        $currentSemester = Settings::get('currentSemester');
        $arrivalDates = Arrival::withStudents($currentSemester)->select(DB::raw('DATE(`arrival`) AS `arrival`'))->distinct()->pluck('arrival');
        $arrivalDatesFormated = [];
        for ($i = 0; $i < count($arrivalDates); $i++) {
            $arrivalDatesFormated[] = [
                'formatted' => Carbon::parse($arrivalDates[$i])->format('j. n. Y'),
                'date' => Carbon::parse($arrivalDates[$i])->format('Y-m-d')
            ];
        }

        return response()->json([
            'countries' => Country::withStudents($currentSemester)->get(),
            'faculties' => Faculty::withStudents($currentSemester)->get(),
            'accommodation' => Accommodation::withStudents($currentSemester)->get(),
            'days' => $arrivalDatesFormated,
        ]);
    }

    public function loadPreregister()
    {
        $this->authorize('acl', 'exchangeStudents.register');

        $lastName = request()->query('lastName') ?? '';
        $firstName = request()->query('firstName') ?? '';
        $id = request()->query('id') ?? '';
        $limit = request()->query('limit') ?? self::DEFAULT_PREREGISTRATION_LIMIT;

        $students = ExchangeStudent::with('person.user')
            ->byUniqueSemester(Settings::get('currentSemester'))
            ->toPreregister($lastName, $firstName, $id)
            ->limit($limit)
            ->get();

        return new PreregistrationStudentCollection($students);
    }

    public function preregister(ExchangeStudent $exchangeStudent)
    {
        $this->authorize('acl', 'exchangeStudents.register');

        $data = request()->validate([
            'phone' => ['required', 'phone:CZ', 'unique:exchange_students'],
            'esn_card_number' => ['required', 'string', 'unique:exchange_students'],
        ]);

        $exchangeStudent->update($data);

        return response()->json([
            'id_user' => $exchangeStudent->id_user
        ]);
    }
}
