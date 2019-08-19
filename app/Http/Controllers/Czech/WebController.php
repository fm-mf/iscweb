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

    function showActivitiesIndexPage() {
        $contactHr = Contacts::getContactByPosition('Human Resources');
        return view('czech.activities', compact('contactHr'));
    }

    function showActivitiesLanguagesPage() {
        $contactLanguages = Contacts::getContactByPosition('Languages Coordinator');
        return view('czech.activities-languages', compact('contactLanguages'));
    }

    function showActivitiesTripsPage() {
        $contactTrips = Contacts::getContactByPosition('Trips Coordinator');
        $contactActivities = Contacts::getContactByPosition('Activities Coordinator');
        return view('czech.activities-trips', compact('contactTrips', 'contactActivities'));
    }

    function showActivitiesInteGreatPage() {
        $contactInteGreat = Contacts::getContactByPosition('inteGREAT Coordinator');
        return view('czech.activities-inteGREAT', compact('contactInteGreat'));
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
