<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Models\ExchangeStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    public function index()
    {
        return view('buddyprogram.index');
    }

    public function listExchangeStudents()
    {
        $students = ExchangeStudent::findAll()->bySemester('fall2016')->withoutBuddy()->get();
        return view('buddyprogram.list')->with(['students' => $students]);
    }
}
