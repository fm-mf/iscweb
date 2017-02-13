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
        $this->authorize('acl', 'events.view');
        $visibleEvents = Event::findAllActive();
        return view('partak.events.dashboard')->with(['activeEvents' => $visibleEvents,]);
    }

    public function showEditForm($id_event)
    {
        $this->authorize('acl', 'events.view');
        $event = Event::find($id_event);
        return view('partak.events.edit')->with([
           'event' => $event,
        ]);
    }

    public function submmitEditForm(Request $request, $id_event)
    {
        $this->authorize('acl', 'events.edit');
        $this->eventValidator($request->all())->validate();
        $event = Event::find($id_event);
        if(isset($event)){
            $data = [];
            foreach ($request->all() as $key => $value) {
                if ($value) {
                    $data[$key] = $value;
                }
            }
            $data['modified_by'] = Auth::id();
            $event->update($data);
            return back()->with(['success' => 'Event was updated successfully']);
        }
        else {
            return back()->with(['!success' => 'Event wasn\'t updated']);
        }
    }

    public function showCreateForm()
    {
        $this->authorize('acl', 'events.add');
        $event = new Event();;
        $event->visible_from = Carbon::now();
        $event->datetime_from = Carbon::now();
        return view('partak.events.create')->with(['event' => $event,]);
    }

    public function submitCreateForm(Request $request)
    {
        $this->authorize('acl', 'events.add');
        $this->eventValidator($request->all())->validate();
        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }
        $data['modified_by'] = Auth::id();
        $event = Event::createEvent($data);
        return \Redirect::route('events.edit',['id_event' => $event->id_event]);
    }

    protected function eventValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'visible_date' => 'required|date_format:d M Y',
            'visible_time' => 'date_format:g:i A',
            'start_date' => 'required|date_format:d M Y',
            'start_time' => 'date_format:g:i A',
        ]);
    }

    public function deleteEvent($id_event)
    {
        $this->authorize('acl', 'events.remove');
        $event = Event::find($id_event);
        $event->participants()->detach();
        $event->delete();
        return back();
    }

}