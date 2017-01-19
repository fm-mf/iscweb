<?php

namespace App\Http\Controllers\Partak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Torann\LaravelAsana\Facade\Asana;

class DashboardController extends Controller
{
    public function index()
    {
        return view('partak.dashboard');
    }
}
