<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function load(Request $request)
    {
        return response()->json([

            'count' => 1,
            'data' => [
                ['Test', 'What'],
                ['Test2', 'What2']
            ]
        ]);
    }
}
