<?php

namespace App\Http\Controllers\Partak;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Torann\LaravelAsana\Facade\Asana;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $martin = User::find(4);
        dd('buddy: ' . $martin->isBuddy(). ', unverified buddy: ' . $martin->isUnverifiedBuddy());
        return view('partak.dashboard')->with(['user' => $request->user()]);
    }

    public function trips(Request $request)
    {
        return view('partak.trips')->with(['user' => $request->user()]);
    }
}
