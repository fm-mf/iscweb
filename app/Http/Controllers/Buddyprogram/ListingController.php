<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Models\Country;
use App\Models\ExchangeStudent;
use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    public function index()
    {
        return view('buddyprogram.index')->with([
            'countries' => Country::allWithStudents('fall2016'),
            'faculties' => Faculty::all()
        ]);
    }

    public function listExchangeStudents()
    {
        $students = ExchangeStudent::findAll()->bySemester('fall2016')->withoutBuddy()->get();

        return view('buddyprogram.list')->with([
            'students' => $students,
            'countries' => Country::all()
        ]);
    }
}
