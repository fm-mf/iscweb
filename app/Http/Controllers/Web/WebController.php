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
        return view('web.contact') -> with(['wcFrom' => $dateFrom->format('l F jS')]);
    }

    public function showCalendar()
    {
        $events = Event::findAllVisible();
        return view('web.calendar')->with(['events' => $events]);
    }

    public function showInteGreatTable()
    {
        $fromDate = Carbon::createFromFormat('d/m/Y' , Settings::get('wcFrom'));
        //$integreatEv = Event::getAllIntegreatEvents($fromDate);
        $integreatEv = Integreat_party::getAllPartiesFrom($fromDate);
        //dd($integreatEv->first()->integreat_party->countries);
        //dd($integreatEv);
        return view('web.activities.integreat')->with([
            'events' => $integreatEv,
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
}