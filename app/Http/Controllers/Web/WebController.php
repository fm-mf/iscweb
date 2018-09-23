<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 20.01.2017
 * Time: 18:15
 */
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Integreat_party;
use App\Models\Languages_event;
use App\Models\Semester;
use App\Facades\Settings;
use App\Facades\Contacts;
use Carbon\Carbon;

class WebController extends Controller
{

    public function showHomePage()
    {
        $events = Event::findAllVisible();
        $more = $events->count() > 3;
        $events = $events->slice(0, 3);
        return view('web.home')->with([
            'events' => $events,
            'more' => $more,
            ]);
    }

    public function showContacts() {
        $dateFrom = Carbon::createFromFormat('d/m/Y' ,Settings::get('wcFrom'));
        $contacts = Contacts::getWebContacts();
        return view('web.contact') -> with(['wcFrom' => $dateFrom->format('l F jS'), 'contacts' => $contacts]);
    }

    public function showCalendar()
    {
        $events = Event::findAllVisible();
        return view('web.calendar')->with(['events' => $events]);
    }

    public function showActivitesPage()
    {
        return view('web.activities')->with([
            'contact' => Contacts::getContactByPosition('Activities Coordinator'),
        ]);
    }

    public function showSportsPage()
    {
        return view('web.activities.sports')->with([
            'contact' => Contacts::getContactByPosition('Sports Coordinator'),
        ]);
    }

    public function showInteGreatPage()
    {
        $fromDate = Carbon::createFromFormat('d/m/Y' , Settings::get('wcFrom'));
        $integreatEv = Integreat_party::getAllPartiesFrom($fromDate);
        $currentSemester = Semester::getCurrentSemester()->getFullName();
        $currentSemester = strtoupper($currentSemester);
        return view('web.activities.integreat')->with([
            'events' => $integreatEv,
            'currentSemester' => $currentSemester,
            'contact' => Contacts::getContactByPosition('inteGREAT Coordinator'),
        ]);
    }

    public function showLanguagesPage()
    {
        $fromDate = Carbon::createFromFormat('d/m/Y' , Settings::get('wcFrom'));
        $langEvents = Languages_event::getLangEventsFrom($fromDate);
        return view('web.activities.languages')->with([
            'langEvents' => $langEvents,
            'contact' => Contacts::getContactByPosition('Languages Coordinator'),
        ]);
    }

    public function redirectToElectionStream()
    {
        $streamUrl = Settings::get('electionStreamUrl');
        return redirect($streamUrl == "" ? url('/') : $streamUrl);
    }

}
