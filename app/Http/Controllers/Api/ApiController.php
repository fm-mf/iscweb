<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ExchangeStudentResource;
use App\Models\Accommodation;
use App\Models\Arrival;
use App\Models\Country;
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
        'accomodation' => 'accommodation.full_name'
    ];

    const FILTER_ALIAS = [
        'countries' => 'exchange_students.id_country',
        'accommodation' => 'exchange_students.id_accommodation',
        'faculties' => 'exchange_students.id_faculty'
    ];

    public function isDatabaseOpen() {
        $curr = Carbon::now();
        $timeStr = Settings::get('buddyDbFrom') . " " . Settings::get('buddyDbFromTime');
        $timeStr = str_replace('/', '-', $timeStr);
        $timeInDb = Carbon::parse($timeStr);
        return $timeInDb->lessThan($curr);
    }

    public function load(Request $request)
    {
        if(!$this->isDatabaseOpen()) return response()->json([]);

        app()->setLocale('cs');
        setlocale(LC_ALL, 'cs_CZ.UTF-8'); // for Carbon formatLocalized method

        $page = $request->page;
        if ($page > 1) {
            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });
        }

        $students = ExchangeStudent::withAll()
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
        if(!$this->isDatabaseOpen()) return response()->json([]);

        app()->setLocale('cs');
        setlocale(LC_ALL, 'cs_CZ.UTF-8'); // for Carbon formatLocalized method

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

    public function loadPreregister(Request $request)
    {
        $this->authorize('acl', 'exchangeStudents.register');

        if ($request->lastName == null) {
            $request->lastName = '';
        }
        $students = ExchangeStudent::with('person.user')
                ->byUniqueSemester(Settings::get('currentSemester'))
                ->join('people', 'people.id_user', 'exchange_students.id_user')
                ->whereNull('esn_card_number')
                ->whereNull('phone')
                ->where('exchange_students.id_user', '<>', $request->id - 1)
                ->whereHas('person', function ($query) use ($request) {
                    $query->where('last_name', '>=', $request->lastName);
                })
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->limit($request->limit)->get();

        ExchangeStudent::setStaticVisible(['id_user', 'person']);
        Person::setStaticVisible(['first_name', 'last_name', 'user']);
        User::setStaticVisible(['email']);

        return response()->json(
            $students
        );
    }

    public function preregister(Request $request)
    {
        $this->authorize('acl', 'exchangeStudents.register');
        
        $student = ExchangeStudent::find($request->id);
        if (!$student) {
            return false;
        }

        $student = ExchangeStudent::find($request->id);
        $student->esn_card_number = $request->esn;
        $student->phone = $request->phone;
        $student->save();
        return $request->id;
    }
}
