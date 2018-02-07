<?php

namespace App\Http\Controllers\Api;

use App\Models\Accommodation;
use App\Models\Arrival;
use App\Models\Country;
use App\Models\ExchangeStudent;
use App\Models\Faculty;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Settings\Facade as Settings;

class ApiController extends Controller
{
    public function load(Request $request)
    {
        if (!Settings::get('isDatabaseOpen')) {
            return [];
        }

        $page = $request->page;
        if ($page > 1) {
            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });
        }

        $students = ExchangeStudent::withAll()->availableToPick(Settings::get('currentSemester'));

        if (is_array($request->filters)) {
            foreach ($request->filters as $filter => $values) {
                if ($values) {
                    $students->filter($filter, $values);
                }
            }
        }

        ExchangeStudent::setStaticVisible(['id_user', 'accommodation', 'arrival', 'country', 'faculty', 'person', 'school']);
        Accommodation::setStaticVisible(['full_name']);
        Arrival::setStaticVisible(['arrival']);
        Country::setStaticVisible(['full_name']);
        Faculty::setStaticVisible(['abbreviation']);
        Person::setStaticVisible(['first_name', 'last_name']);

        return response()->json(
            $students->paginate(50)
        );
    }

    public function loadPreregister(Request $request)
    {
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
