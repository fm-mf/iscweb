<?php
/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 5.2.17
 * Time: 9:41
 */

namespace App\Http\Controllers\Partak;

use App\Models\Buddy;
use App\Models\Event;
use App\Models\ExchangeStudent;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class EventController extends Controller
{
    public function showDashboard()
    {
        //dd(\Carbon\Carbon::today()->toDateTimeString());
        $visibleEvents = Event::findAllVisible();
        return view('partak.trips.dashboard')->with(['visibleEvents' => $visibleEvents,]);
    }

    public function showDetail($id)
    {
        $event = Event::find($id);
        $particip = $event->participants()->with('person.user')->get();
        $organizers = $event->organizers()->with('person.user')->get();
        return view('partak.trips.detail')->with([
           'trip' => $event,
            'particip' => $particip,
            'organizers' => $organizers,
        ]);
    }

    public function addToEvent($id_event, $id_part)
    {
        (Event::find($id_event)->isFull()) ? $stand_in = 'y' : $stand_in = 'n';
        $part = ExchangeStudent::find($id_part);
        $part->events()->attach($id_event, ['stand_in' => $stand_in]);
        return back()->with(['addSuccess' => true]);
    }

    public function removeFromEvent($id_event, $id_part)
    {
        $part = ExchangeStudent::find($id_part);
        if(Event::find($id_event)->isFull())
        {
            $stand_in = Event::find($id_event)->standInParticipants()->first();
            if(isset($stand_in))
            {
                $stand_in->events()->updateExistingPivot($id_event, ['stand_in' => 'n']);
            }
        }
        $part->events()->detach($id_event);
        return back()->with(['removeSuccess' => true]);
    }

    public function showEditForm($id_event)
    {
        $event = Event::find($id_event);
        dd($event->organizers()->with('person.user')->get());
        JavaScript::put([
            'jsoptions' => ['organizers' => Buddy::all(), 'sroles' => $event->organizers()->with('person.user')->get()]
        ]);

        return view('partak.trips.edit')->with([
            'event' => $event,
        ]);
    }

}