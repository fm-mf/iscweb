<?php
/**
 * Created by PhpStorm.
 * User: tucna
 * Date: 07.12.2018
 * Time: 20:59
 */
namespace App\Http\Controllers\Czech;

use App\Http\Controllers\Controller;
use App\Models\Event;

class WebController extends Controller
{
    function showHomePage() {
        return view('czech.home');
    }

    function showAboutUsPage() {
        return view('czech.about-us');
    }

    function showActivitiesPage() {
        return view('czech.activities');
    }

    function showCalendarPage() {
        $events = Event::findAllVisible();
        return view('czech.calendar')->with(['events' => $events]);
    }

    function showContactsPage() {
        return view('czech.contacts');
    }
}