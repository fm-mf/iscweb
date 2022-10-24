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
        return view('partak.dashboard')->with(['user' => $request->user()]);
    }

    public function users(Request $request)
    {
        if($request->user()->can('acl', 'buddy.view'))
        {
            return redirect()->action('Partak\BuddiesController@showBuddiesDashboard');
        }
        elseif($request->user()->can('acl', 'exchangeStudents.view'))
        {
            return redirect()->action('Partak\ExchangeStudentsController@showExchangeStudentDashboard');
        }
        else
        {
            throw new \Illuminate\Auth\Access\AuthorizationException('You are not authorized');
        }
    }
}
