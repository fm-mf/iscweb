<?php

namespace App\Http\Controllers\Saf;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SafController extends Controller
{
    public function showIndex()
    {
        return view('saf.index');
    }
}
