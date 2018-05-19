<?php
/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 5.2.17
 * Time: 9:41
 */

namespace App\Http\Controllers\Partak;


use App\Models\Event;
use App\Models\Integreat_party;
use App\Models\Languages_event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    public function showDashboard()
    {
        $this->authorize('acl', 'events.view');
        $fromDate = Carbon::createFromFormat('d/m/Y' , Settings::get('wcFrom'));
        $visibleEvents = Event::findAllNormalActive()->sortby('datetime_from');
        $integreatEvents = Event::findAllInteGreatInFromDate($fromDate);
        $languagesEvents = Event::findAllLanguagesFromDate($fromDate);
        $oldEvents = Event::findMaxYearOld()->sortByDesc('datetime_from');
        return view('partak.events.dashboard')->with([
            'activeEvents' => $visibleEvents,
            'oldEvents' => $oldEvents,
            'languagesEvents' => $languagesEvents,
            'integreatEvents' => $integreatEvents,
            ]);
    }

    public function showEditForm(Request $request, $id_event)
    {
        $this->authorize('acl', 'events.view');
        $event = Event::with('Integreat_party', 'Languages_event')->find($id_event);
        return view('partak.events.edit')->with([
            'event' => $event,
            'event_types' => Event::getAllTypes(),
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
            if($data['event_type'] == 'integreat')
            {
                if(isset($event->integreat_party))
                {
                    $event->integreat_party->update($data);
                } else {
                    Integreat_party::creatParty($event->id_event, $data);
                }

            } else if ($data['event_type'] == 'languages') {
                if(isset($event->languages_event))
                {
                    $event->languages_event->update($data);
                } else {
                    Languages_event::creatLanguagesEvent($event->id_event, $data);
                }
            }
            if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $image_name = $event->id_event . '.' . $file->extension();
                \File::delete(storage_path() . '/app/events/covers/' . $event->cover);
                Image::make($file)->save(storage_path() . '/app/events/covers/' . $image_name);
                $data['cover'] = $image_name;
            }
            $event->update($data);
            return back()->with([
                'successUpdate' => 'Event was successfully updated.',
                ]);
        }
        else {
            return back()->with(['!success' => 'Event wasn\'t updated']);
        }
    }

    public function showCreateForm(Request $request)
    {
        $this->authorize('acl', 'events.add');
        $event = new Event();
        $event->cover = null;
        $event->visible_from = Carbon::now();
        $event->datetime_from = Carbon::now();
        if ($request->is('partak/events/create/integreat')) {
            $event->event_type = 'integreat';
            $event->integreat_party = new Integreat_party();
        } else if($request->is('partak/events/create/languages')){
            $event->event_type = 'languages';
            $event->languages_event = new Languages_event();
        }
        return view('partak.events.create')->with([
            'event' => $event,
            'event_types' => $event->getAlltypes(),
            'create' => true,
        ]);

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
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $image_name = $event->id_event . '.' . $file->extension();
            Image::make($file)->save(storage_path() . '/app/events/covers/' . $image_name);
            $event['cover'] = $image_name;
        }
        if($data['event_type'] == 'integreat'){
            Integreat_party::creatParty($event->id_event, $data);
        } else if($data['event_type'] == 'languages') {
            Languages_event::creatLanguagesEvent($event->id_event, $data);
        }
        $event->save();
        return \Redirect::route('events.edit',[
            'id_event' => $event->id_event,
            ])->with(['successUpdate' => 'Event was successfully created.',]);
    }

    protected function eventValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'visible_date' => 'required|date_format:d M Y',
            'visible_time' => 'date_format:g:i A',
            'start_date' => 'required|date_format:d M Y',
            'start_time' => 'date_format:g:i A',
            'description' => 'required',
            'cover' => 'max:307400|mimes:jpg,jpeg,png',
        ]);
    }

    public function deleteEvent($id_event)
    {
        $this->authorize('acl', 'events.remove');
        $event = Event::find($id_event);
        $name = $event->name;
        $event->Integreat_party()->delete();
        $event->Languages_event()->delete();
        $event->delete();
        return back()->with(['eventDeleted' => "Event \"$name\" has been deleted."]);
    }

}
