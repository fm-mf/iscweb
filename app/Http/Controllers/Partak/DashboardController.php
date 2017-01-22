<?php

namespace App\Http\Controllers\Partak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Torann\LaravelAsana\Facade\Asana;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('partak.dashboard')->with(['user' => $request->user()]);
    }

    public function trips(Request $request)
    {
        return view('partak.trips')->with(['user' => $request->user()]);
    }
}
