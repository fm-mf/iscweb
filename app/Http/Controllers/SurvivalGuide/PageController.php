<?php

namespace App\Http\Controllers\SurvivalGuide;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function showPage()
    {
        return view('guide.page');
    }
}
