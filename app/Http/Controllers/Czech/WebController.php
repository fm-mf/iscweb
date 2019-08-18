<?php
/**
 * Created by PhpStorm.
 * User: tucna
 * Date: 07.12.2018
 * Time: 20:59
 */
namespace App\Http\Controllers\Czech;

use App\Facades\Contacts;
use App\Http\Controllers\Controller;
use App\Models\Event;

class WebController extends Controller
{
    public function __construct()
    {
        app()->setLocale('cs');
    }

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

    function showFaqPage()
    {
        return view('czech.faq');
    }

    function showBuddyProgramPage()
    {
        $contacts[] = Contacts::getContactByPosition('Buddy Coordinator');
        $contacts[] = Contacts::getContactByPosition('Human Resources');
        return view('czech.buddy-program')->with([
            'contacts' => $contacts,
        ]);
    }

    function showContactsPage() {
        return view('czech.contacts');
    }
}
