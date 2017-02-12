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
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use App\Models\Faculty;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function showDashboard()
    {
        $this->authorize('acl', 'trips.view');
        $visibleEvents = Event::findAllVisible();
        return view('partak.trips.dashboard')->with(['visibleEvents' => $visibleEvents,]);
    }

    public function showDetail($id)
    {
        $this->authorize('acl', 'trips.view');
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
        $this->authorize('acl', 'participant.add');
        (Event::find($id_event)->isFull()) ? $stand_in = 'y' : $stand_in = 'n';
        $part = ExchangeStudent::find($id_part);
        $part->events()->attach($id_event, ['stand_in' => $stand_in]);
        return back()->with(['addSuccess' => true]);
    }

    public function removeFromEvent($id_event, $id_part)
    {
        $this->authorize('acl', 'participant.remove');
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
        $this->authorize('acl', 'trips.edit');
        $this->authorize('acl', 'trips');
        $event = Event::find($id_event);
        //dd($event->organizers()->with('person.user')->get());

        JavaScript::put([
            'jsoptions' => ['organizers' => Buddy::all(), 'sorganizers' => $event->organizers()->with('person')->get()]
        ]);
        return view('partak.trips.edit')->with([
            'event' => $event,
        ]);
    }

    private function updateEvent($request, $event)
    {
        $event->description = $request->description;
        $event->name = $request->name;

        $time = $request->visible_time ? $request->visible_time : "00:00 AM";
        $event->visible_from = Carbon::createFromFormat('d M Y g:i A', $request->visible_date . ' ' . $time);

        $time = $request->registration_time ? $request->registration_time : "00:00 AM";
        $event->registration_to = Carbon::createFromFormat('d M Y g:i A', $request->registration_date . ' ' . $time);

        $time = $request->start_time ? $request->start_time : "00:00 AM";
        $event->datetime_from = Carbon::createFromFormat('d M Y g:i A', $request->start_date . ' ' . $time);

        $time = $request->end_time ? $request->end_time : "00:00 AM";
        $event->datetime_to = Carbon::createFromFormat('d M Y g:i A', $request->end_date . ' ' . $time);

        $event->facebook_url = $request->facebook_url;
        $event->capacity = $request->capacity;
        $event->price = $request->price;
        $event->modified_id_user = Auth::id();

        $event->save();
    }

    public function updateEditForm(Request $request, $id_event)
    {
        $this->authorize('acl', 'trips.edit');
        $this->eventValidator($request->all())->validate();
        $event = Event::find($id_event);
        if(isset($event)){
            $this->updateEvent($request, $event);
            return back()->with(['success' => 'Event was updated successfully']);
        }
        else {
            return back()->with(['!success' => 'Event wasn\'t updated']);
        }
    }

    public function showCreateForm()
    {
        $this->authorize('acl', 'trips.add');
        $event = new Event();;
        $event->visible_from = Carbon::now();
        $event->datetime_from = Carbon::now();
        $event->registration_to = Carbon::now();
        $event->datetime_to = Carbon::now();
        return view('partak.trips.Create')->with(['event' => $event,]);
    }

    public function submiteCreateForm(Request $request)
    {
        $this->authorize('acl', 'trips.add');
        $this->eventValidator($request->all())->validate();
        $event = new Event();
        $this->updateEvent($request, $event);
        return \Redirect::route('trips.edit',['id_event' => $event->id_event]);
    }

    protected function eventValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'visible_date' => 'required|date_format:d M Y',
            'visible_time' => 'date_format:g:i A',
            'registration_date' => 'date_format:d M Y',
            'registration_time' => 'date_format:g:i A',
            'start_date' => 'required|date_format:d M Y',
            'start_time' => 'date_format:g:i A',
            'end_date' => 'required|date_format:d M Y',
            'end_time' => 'date_format:g:i A',
        ]);
    }

    public function deleteEvent($id_event)
    {
        $this->authorize('acl', 'trips.remove');
        $event = Event::find($id_event);
        $event->participants()->detach();
        $event->delete();
        return back();
    }

}