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

    private $maleSilhouette     = 'img/web/contacts/male-silhouette-150.jpg';
    private $femaleSilhouette   = 'img/web/contacts/female-silhouette-150.jpg';
    private $contactImageFolder = 'img/web/contacts/2018-fall';

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
        return
            [
                [
                    'name' => 'Tereza Faltysová',
                    'position' => 'President',
                    'email' => 'president@isc.cvut.cz',
                    'phone' => '+420 777 085 390',
                    'avatar' => asset("{$this->contactImageFolder}/president-terka.jpg")
                ],
                [
                    'name' => 'Michaela Šímová',
                    'position' => 'Vicepresident',
                    'email' => 'vicepresident@isc.cvut.cz',
                    'phone' => '+420 722 588 477',
                    'avatar' => asset("{$this->contactImageFolder}/vicepresident-misa.jpg")
                ],
                [
                    'name' => 'Michaela Petříková',
                    'position' => 'Human Resources',
                    'email' => 'hr@isc.cvut.cz',
                    'phone' => '',
                    //'avatar' => asset("{$this->contactImageFolder}/activities-misa.jpg")),
                    'avatar' => $this->femaleSilhouette
                ],
                [
                    'name' => 'Martin "Speedy" Průcha',
                    'position' => 'Treasurer',
                    'email' => 'treasurer@isc.cvut.cz',
                    'phone' => '+420 736 683 644',
                    'avatar' => asset("{$this->contactImageFolder}/treasurer-speedy.jpg")
                ],
                [
                    'name' => 'Jakub Nový',
                    'position' => 'Public Relations',
                    'email' => 'pr@isc.cvut.cz',
                    'phone' => '',
                    'avatar' => asset($this->maleSilhouette)
                ],
                [
                    'name' => 'Matěj Mysliveček',
                    'position' => 'Local Representative',
                    'email' => 'lr@isc.cvut.cz',
                    'phone' => '+420 777 669 787',
                    'avatar' => asset("{$this->contactImageFolder}/lr-matej.jpg")
                ],
                [
                    'name' => 'Eva Machová',
                    'position' => 'Quality and Knowledge Manager',
                    'email' => 'knowledge@isc.cvut.cz',
                    'phone' => '+420 736 724 862',
                    'avatar' => asset("{$this->contactImageFolder}/qak-evca.jpg")
                ],
                [
                    'name' => 'Zuzana Havlíčková',
                    'position' => 'inteGREAT Coordinator',
                    'email' => 'integreat@isc.cvut.cz',
                    'phone' => '+420 606 267 536',
                    'avatar' => asset($this->femaleSilhouette)
                ],
                [
                    'name' => 'Tomáš Hrdlovics',
                    'position' => 'Point Coordinator',
                    'email' => 'point@isc.cvut.cz',
                    'phone' => '',
                    'avatar' => asset($this->maleSilhouette)
                ],
                [
                    'name' => 'Václav David',
                    'position' => 'Activities Coordinator',
                    'email' => 'activities@isc.cvut.cz',
                    'phone' => '+420 731 858 146',
                    'avatar' => asset("{$this->contactImageFolder}/activities-vasek.jpg")
                ],
                [
                    'name' => 'Marek Stehlík',
                    'position' => 'Languages Coordinator',
                    'email' => 'languages@isc.cvut.cz',
                    'phone' => '',
                    'avatar' => asset($this->maleSilhouette)
                ],
                [
                    'name' => 'Martin Petráček',
                    'position' => 'Buddy Coordinator',
                    'email' => 'buddy@isc.cvut.cz',
                    'phone' => '+420 736 234 990',
                    'avatar' => asset("{$this->contactImageFolder}/buddy-martin.jpg")
                ],
                [
                    'name' => 'Petr Fiedler',
                    'position' => 'IT Coordinator',
                    'email' => 'it@isc.cvut.cz',
                    'phone' => '+420 608 990 369',
                    'avatar' => asset("{$this->contactImageFolder}/it-fida.jpg")
                ],
                [
                    'name' => 'Michal Štádler',
                    'position' => 'Alumni Coordinator',
                    'email' => 'alumni@isc.cvut.cz',
                    'phone' => '', //'+420 607 100 631',
                    'avatar' => asset("{$this->contactImageFolder}/alumni-michal.jpg")
                ],
//                array (
//                        'name' => 'Vojta Kubica',
//                        'position' => 'Sports Coordinator',
//                        'email' => 'sports@isc.cvut.cz',
//                        'phone' => '',
//                        'avatar' => asset("{$this->contactImageFolder}/sports.jpg")),
                [
                    'name' => 'Michal Nečas',
                    'position' => 'ISC Care Coordinator',
                    'email' => 'care@isc.cvut.cz',
                    'phone' => '',
//                        'avatar' => asset("{$this->contactImageFolder}/care.jpg")
                    'avatar' => asset($this->maleSilhouette)
                ],
                [
                    'name' => 'Lukáš Turčan',
                    'position' => 'Visa Coordinator',
                    'email' => 'visa@isc.cvut.cz',
                    'phone' => '',
                    //'avatar' => asset("{$this->contactImageFolder}/visa.jpg")
                    'avatar' => asset($this->maleSilhouette)
                ]
            ];
    }
}
