<?php

namespace App\Http\Controllers\Partak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function showSearchUsers()
    {
        return view('partak.roles.search');
    }
}
