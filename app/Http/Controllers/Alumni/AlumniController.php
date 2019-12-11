<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;

class AlumniController extends Controller
{

    public function __construct()
    {
        app()->setLocale('cs');
        setlocale(LC_ALL, 'cs_CZ.UTF-8'); // for Carbon formatLocalized method
    }

    public function index()
    {
        return view('alumni.index');
    }
}
