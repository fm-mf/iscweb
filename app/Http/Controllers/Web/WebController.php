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
use App\Settings\Facade as Settings;
use App\Models\ExchangeStudent;
use Carbon\Carbon;
use Hamcrest\Core\Set;

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
        $contacts = $this->getContactsArray();
        return view('web.contact') -> with(['wcFrom' => $dateFrom->format('l F jS'), 'contacts' => $contacts]);
    }

    public function showCalendar()
    {
        $events = Event::findAllVisible();
        return view('web.calendar')->with(['events' => $events]);
    }

    public function showInteGreatTable()
    {
        $fromDate = Carbon::createFromFormat('d/m/Y' , Settings::get('wcFrom'));
        $integreatEv = Integreat_party::getAllPartiesFrom($fromDate);
        $currentSemester = Semester::getCurrentSemester()->getFullName();
        $currentSemester = strtoupper($currentSemester);
        return view('web.activities.integreat')->with([
            'events' => $integreatEv,
            'currentSemester' => $currentSemester,
        ]);
    }

    public function showLanguagesTable()
    {
        $fromDate = Carbon::createFromFormat('d/m/Y' , Settings::get('wcFrom'));
        //$integreatEv = Event::getAllIntegreatEvents($fromDate);
        $langEvents = Languages_event::getLangEventsFrom($fromDate);
        //dd($integreatEv->first()->integreat_party->countries);
        //dd($integreatEv);
        return view('web.activities.languages')->with([
            'langEvents' => $langEvents,
        ]);
    }

    public function redirectToElectionStream()
    {
        $streamUrl = Settings::get('electionStreamUrl');
        if ($streamUrl != "") {
            return redirect($streamUrl);
        }
        return redirect(url('/'));
    }

    private function getContactsArray()
    {
        return array(
                array (
                        'name' => 'Tereza Faltysová',
                        'position' => 'President',
                        'email' => 'president@isc.cvut.cz',
                        'phone' => '+420 777 085 390',
                        'avatar' => asset('img/web/contacts/2017fall/buddy-faltysova.jpg')),
                array (
                        'name' => 'Michaela Šímová',
                        'position' => 'Vicepresident',
                        'email' => 'vicepresident@isc.cvut.cz',
                        'phone' => '+420 722 588 477',
                        'avatar' => asset('img/web/contacts/2017spring/Care_Misa.jpg')),
                array (
                        'name' => 'Tomáš Hanousek',
                        'position' => 'Human Resources',
                        'email' => 'hr@isc.cvut.cz',
                        'phone' => '+420 605 982 464',
                        'avatar' => asset('img/web/contacts/2017fall/hr-kebab.jpg')),
                array (
                        'name' => 'Martin "Speedy" Průcha',
                        'position' => 'Treasurer',
                        'email' => 'treasurer@isc.cvut.cz',
                        'phone' => '+420 736 683 644',
                        'avatar' => asset('img/web/contacts/2017fall/vicepresident-speedy.jpg')),
                array (
                        'name' => 'Jan Jarkovský',
                        'position' => 'Public Relations',
                        'email' => 'pr@isc.cvut.cz',
                        'phone' => '+420 721 767 340',
                        'avatar' => asset('img/web/contacts/2017fall/pr-janek.jpg')),
                array (
                        'name' => 'Matěj Mysliveček',
                        'position' => 'Local Representative',
                        'email' => 'lr@isc.cvut.cz',
                        'phone' => '+420 777 669 787',
                        'avatar' => asset('img/web/contacts/male-silhouette-150.jpg')),
                array (
                        'name' => 'Eva Machová',
                        'position' => 'Quality and Knowledge Manager',
                        'email' => 'knowledge@isc.cvut.cz',
                        'phone' => '+420 736 724 862',
                        'avatar' => asset('img/web/contacts/2017spring/PR_Evca.jpg')),
                array (
                        'name' => 'Zuzana Havlíčková',
                        'position' => 'inteGREAT Coordinator',
                        'email' => 'integreat@isc.cvut.cz',
                        'phone' => '',// '+420 606 267 536',
                        'avatar' => asset('img/web/contacts/female-silhouette-150.jpg')),
                array (
                        'name' => 'Petr Fiedler',
                        'position' => 'Point Coordinator',
                        'email' => 'point@isc.cvut.cz',
                        'phone' => '+420 608 990 369',
                        'avatar' => asset('img/web/contacts/male-silhouette-150.jpg')),
                array (
                        'name' => 'Václav David',
                        'position' => 'Activities Coordinator',
                        'email' => 'activities@isc.cvut.cz',
                        'phone' => '+420 731 858 146',
                        'avatar' => asset('img/web/contacts/male-silhouette-150.jpg')),
                array (
                        'name' => 'Kateřina Čermáková',
                        'position' => 'Languages Coordinator',
                        'email' => 'languages@isc.cvut.cz',
                        'phone' => '+420 775 381 406',
                        'avatar' => asset('img/web/contacts/female-silhouette-150.jpg')),
                array (
                        'name' => 'Martin Petráček',
                        'position' => 'Buddy Coordinator',
                        'email' => 'buddy@isc.cvut.cz',
                        'phone' => '+420 736 234 990',
                        'avatar' => asset('img/web/contacts/male-silhouette-150.jpg')),
                array (
                        'name' => 'Filip Marek',
                        'position' => 'IT Coordinator',
                        'email' => 'it@isc.cvut.cz',
                        'phone' => '+420 732 227 056',
                        'avatar' => asset('img/web/contacts/2017fall/it-filip.jpg')),
                array (
                        'name' => 'Michal Štádler',
                        'position' => 'Alumni Coordinator',
                        'email' => 'alumni@isc.cvut.cz',
                        'phone' => '', //'+420 607 100 631',
                        'avatar' => asset('img/web/contacts/2017spring/Video_Misa.jpg')),/*
                array (
                        'name' => 'Petr Šlajs',
                        'position' => 'Sports Coordinator',
                        'email' => 'sports@isc.cvut.cz',
                        'phone' => '+420 724 537 680',
                        'avatar' => asset('img/web/contacts/2017spring/Sports_Petr.jpg')),*/
                array (
                        'name' => 'Michal Cihlář',
                        'position' => 'ISC Care Coordinator',
                        'email' => 'care@isc.cvut.cz',
                        'phone' => '+420 734 897 378',
                          'avatar' => asset('img/web/contacts/male-silhouette-150.jpg')),
                array (
                        'name' => 'Jakub Švehla',
                        'position' => 'Visa Coordinator',
                        'email' => 'visa@isc.cvut.cz',
                        'phone' => '+420 603 831 593',
                        'avatar' => asset('img/web/contacts/2017fall/visa-kuba.jpg')),
            /*
                array (
                        'name' => 'Vojtěch Zacharda',
                        'position' => 'Photo Coordinator',
                        'email' => 'photo@isc.cvut.cz',
                        'phone' => '+420 776 690 976',
                        'avatar' => asset('img/web/contacts/2017spring/Photo_Vojta.jpg')),
                array (
                        'name' => 'Michal Štádler',
                        'position' => 'Video Coordinator',
                        'email' => 'video@isc.cvut.cz',
                        'phone' => '+420 607 100 631',
                        'avatar' => asset('img/web/contacts/2017spring/Video_Misa.jpg')),
                array (
                        'name' => 'Nicol Minichová',
                        'position' => 'Promo Coordinator',
                        'email' => 'promo@isc.cvut.cz',
                        'phone' => '+420 ',
                        'avatar' => asset('img/web/contacts/2017spring/Promo_Nicol.jpg')),
                array (
                        'name' => 'Pavel Hošek',
                        'position' => 'Press Coordinator',
                        'email' => 'press@isc.cvut.cz',
                        'phone' => '+420 728 356 682',
                        'avatar' => asset('img/web/contacts/2017spring/Press_Pavel.jpg')),*/
        );
    }
}
