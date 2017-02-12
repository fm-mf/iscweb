<?php

namespace App\Http\Controllers\Api;

use App\Models\ExchangeStudent;
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

        $students = ExchangeStudent::findAll()->byUniqueSemester(Settings::get('currentSemester'))
            ->withoutBuddy()->wantBuddy()->whereNotNull('about');

        if (is_array($request->filters)) {
            foreach ($request->filters as $filter => $values) {
                if ($values) {
                    $students->filter($filter, $values);
                }
            }
        }

        return response()->json(
            $students->paginate(50)
        );
    }

    public function loadPreregister(Request $request)
    {
        $students = ExchangeStudent::with('person.user')->byUniqueSemester(Settings::get('currentSemester'))->whereNull('esn_card_number')->whereNull('phone')->where('id_user', '>=', $request->id)->limit($request->limit)->get();
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
