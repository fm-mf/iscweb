<?php

namespace App\Http\Controllers\Api;

use App\Models\ExchangeStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class ApiController extends Controller
{
    public function load(Request $request)
    {
        $page = $request->page;
        if ($page > 1) {
            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });
        }

        $students = ExchangeStudent::findAll()->bySemester('fall2016')->withoutBuddy();

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
}
