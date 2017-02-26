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
use App\Settings\Facade as Settings;
use App\Models\ExchangeStudent;
use Carbon\Carbon;

class WebController extends Controller
{
    public function showContacts() {
        $dateFrom = Carbon::createFromFormat('d/m/Y' ,Settings::get('wcFrom'));
        return view('web.contact') -> with(['wcFrom' => $dateFrom->format('l F jS')]);
    }

    public function showCalendar()
    {
        $events = Event::findAllVisible();
        return view('web.calendar')->with(['events' => $events]);
    }
}