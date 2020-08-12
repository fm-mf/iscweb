<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Facades\Settings ;
use App\Models\Buddy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        setlocale(LC_ALL, 'cs_CZ.UTF-8'); // for Carbon formatLocalized method
    }

    public function showClosed()
    {
        return view('buddyprogram.closed');
    }

    public function listExchangeStudents()
    {
        if (!Settings::get('isDatabaseOpen')) {
            return $this->showClosed();
        }

        return view('buddyprogram.list');
    }

    public function listMyStudents()
    {
        $me = Buddy::find(Auth::user()->id_user);

        $myStudents = $me->exchangeStudents()->with('person.user')->bySemester(Settings::get('currentSemester'))->get();

        return view('buddyprogram.mystudents')->with([
                'myStudents' => $myStudents
            ]);
    }
}
