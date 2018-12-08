<?php
/**
 * Created by PhpStorm.
 * User: tucna
 * Date: 07.12.2018
 * Time: 20:59
 */
namespace App\Http\Controllers\Czech;

use App\Http\Controllers\Controller;

class WebController extends Controller
{
    function showHomePage() {
        return view('czech.home')->with([
            'events' => null,
            'more' => null,
        ]);
    }
}