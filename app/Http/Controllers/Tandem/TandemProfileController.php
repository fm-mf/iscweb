<?php

namespace App\Http\Controllers\Tandem;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Language;

class TandemProfileController extends Controller
{
    public function edit()
    {
        return view('tandem.my-profile')->with([
            'tandemUser' => auth('tandem')->user(),
            'countries' => Country::all(),
            'languages' => Language::all(),
        ]);
    }

    public function update()
    {
        // TODO: validate, save
    }
}
