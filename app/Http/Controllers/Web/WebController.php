<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 20.01.2017
 * Time: 18:15
 */
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Integreat_party;
use App\Models\Languages_event;
use App\Models\Semester;
use App\Models\OpeningHoursMode;
use App\Facades\Settings;
use Carbon\Carbon;

class WebController extends Controller
{
    public function showLangSelection()
    {
        return view('web.language-selection');
    }

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
        $contacts = Contact::visibleOnWeb()->get();
        return view('web.contact') -> with(['wcFrom' => $dateFrom->format('l F jS'),
                                            'contacts' => $contacts,
                                            'openingHoursText' => OpeningHoursMode::getCurrentText(),
                                            'openingHoursTable' => OpeningHoursMode::buildHoursTable()]);
    }

    public function showCalendar()
    {
        $events = Event::findAllVisible();
        return view('web.calendar')->with(['events' => $events]);
    }

    public function showActivitesPage()
    {
        return view('web.activities')->with([
            'contact' => Contact::byPosition('Activities Coordinator')->first(),
        ]);
    }

    public function showSportsPage()
    {
        $currentSemester = Semester::getCurrentSemester()->getFullName();
        $currentSemester = strtoupper($currentSemester);

        // TODO add fetching sports form DB

        return view('web.activities.sports')->with([
            'currentSemester' => $currentSemester,
            'contact' => Contact::byPosition('Sports Coordinator')->first(),
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
            'contact' => Contact::byPosition('inteGREAT Coordinator')->first(),
        ]);
    }

    public function showTripsPage()
    {
        $currentSemester = Semester::getCurrentSemester()->getFullName();
        $currentSemester = strtoupper($currentSemester);

        return view('web.activities.trips')->with([
            'currentSemester' => $currentSemester,
            'contact' => Contact::byPosition('Trips Coordinator')->first(),
        ]);
    }

    public function showLanguagesPage()
    {
        $fromDate = Carbon::createFromFormat('d/m/Y' , Settings::get('wcFrom'));
        $langEvents = Languages_event::getLangEventsFrom($fromDate);
        $currentSemester = Semester::getCurrentSemester()->getFullName();
        $currentSemester = strtoupper($currentSemester);

        return view('web.activities.languages')->with([
            'langEvents' => $langEvents,
            'currentSemester' => $currentSemester,
            'contact' => Contact::byPosition('Languages Coordinator')->first(),
        ]);
    }

    public function showFaqPage()
    {
        $linkExchangeGroup = Settings::get('fbGroupLink');

        return view('web.faq', compact('linkExchangeGroup'));
    }

    public function redirectToElectionStream()
    {
        $streamUrl = Settings::get('electionStreamUrl');
        return redirect($streamUrl == "" ? url('/') : $streamUrl);
    }

}
