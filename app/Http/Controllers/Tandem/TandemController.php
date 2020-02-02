<?php

namespace App\Http\Controllers\Tandem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TandemController extends Controller
{
    public function index()
    {
        return view('tandem.index');
    }

    public function main()
    {
        return view('tandem.main');
    }

    public function profile()
    {
        return view('tandem.profile');
    }
}
