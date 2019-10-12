<?php

namespace App\Http\Controllers\Api;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    public function getExchangeStudent(Request $request)
    {
        $student = ExchangeStudent::findByEmailAndEsn($request->input('email'), $request->input('esn'));

        return response()->json($student);
    }

    public function getBuddy(Request $request)
    {
        $student = Buddy::findByEmailAndPassword($request->input('email'), $request->input('password'));

        return response()->json($student);
    }
}
