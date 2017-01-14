<?php

namespace App\Http\Controllers\Api;

use App\Models\ExchangeStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function load(Request $request)
    {

        $students = ExchangeStudent::findAll();
        foreach ($request->filters as $filter => $values) {
            $students->filter($filter, $values);
        }

        $students->limit(10);

        return response()->json([
            'pages' => 1,
            'data' => $students->get()->toArray()
        ]);
    }
}
