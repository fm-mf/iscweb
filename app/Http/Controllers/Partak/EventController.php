<?php

namespace App\Http\Controllers\Partak;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Integreat_party;
use App\Models\Languages_event;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $this->authorize('acl', 'events.view');

        $fromDate = Carbon::createFromFormat('d/m/Y', Settings::get('wcFrom'));

        $visibleEvents = Event::findAllNormalActive()->sortby('datetime_from');
        $integreatEvents = Event::findAllInteGreatInFromDate($fromDate);
        $languagesEvents = Event::findAllLanguagesFromDate($fromDate);
        $oldEvents = Event::findMaxYearOld()->sortByDesc('datetime_from');

        return view('partak.events.index')->with([
            'activeEvents' => $visibleEvents,
            'oldEvents' => $oldEvents,
            'languagesEvents' => $languagesEvents,
            'integreatEvents' => $integreatEvents,
        ]);
    }

    public function edit(Event $event)
    {
        $this->authorize('acl', 'events.view');

        $event->load(['Integreat_party', 'Languages_event']);

        $semesterId = Semester::getCurrentSemester()->id_semester;
        $semesters = Semester::orderBy('id_semester', 'desc')
            ->pluck('semester', 'id_semester');

        return view('partak.events.edit')->with([
            'event' => $event,
            'event_types' => Event::getAllTypes(),
            'semesters' => $semesters,
            'currentSemesterId' => $semesterId,
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('acl', 'events.edit');

        $this->eventValidator($request->all())->validate();

        if (isset($event)) {
            $data = [];
            foreach ($request->all() as $key => $value) {
                if ($value) {
                    $data[$key] = $value;
                }
            }
            $data['modified_by'] = Auth::id();
            if ($data['event_type'] == 'integreat') {
                if (isset($event->integreat_party)) {
                    $event->integreat_party->update($data);
                } else {
                    Integreat_party::creatParty($event->id_event, $data);
                }
            } else if ($data['event_type'] == 'languages') {
                if (isset($event->languages_event)) {
                    $event->languages_event->update($data);
                } else {
                    Languages_event::creatLanguagesEvent($event->id_event, $data);
                }
            }
            if ($request->hasFile('cover')) {
                $event->storeCover($request->file('cover'));
                unset($data['cover']);
            }
            $event->update($data);

            return back()->with([
                'successUpdate' => 'Event was successfully updated.',
            ]);
        } else {
            return back()->with(['!success' => 'Event wasn\'t updated']);
        }
    }

    public function create(Request $request)
    {
        $this->authorize('acl', 'events.add');

        $event = new Event();
        $event->cover = null;
        $event->visible_from = Carbon::now();
        $event->datetime_from = Carbon::now();

        if ($request->routeIs('partak.events.create.integreat')) {
            $event->event_type = 'integreat';
            $event->integreat_party = new Integreat_party();
        } else if ($request->routeIs('partak.events.create.languages')) {
            $event->event_type = 'languages';
            $event->languages_event = new Languages_event();
        }

        $semesterId = Semester::getCurrentSemester()->id_semester;
        $semesters = Semester::orderBy('id_semester', 'desc')
            ->pluck('semester', 'id_semester');

        return view('partak.events.create')->with([
            'event' => $event,
            'event_types' => $event->getAlltypes(),
            'create' => true,
            'semesters' => $semesters,
            'currentSemesterId' => $semesterId,
        ]);
    }

    public function store(Request $request)
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
            $event->storeCover($request->file('cover'));
        }
        if ($data['event_type'] == 'integreat') {
            Integreat_party::creatParty($event->id_event, $data);
        } else if ($data['event_type'] == 'languages') {
            Languages_event::creatLanguagesEvent($event->id_event, $data);
        }
        $event->save();

        return \Redirect::route('partak.events.edit', [
            'id_event' => $event->id_event,
        ])->with(['successUpdate' => 'Event was successfully created.',]);
    }

    protected function eventValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'id_semester' => 'required|exists:semesters',
            'location' => 'nullable|string|max:255',
            'location_url' => 'nullable|string|url|max:255',
            'facebook_url' => 'nullable|string|url|max:255',
            'visible_date' => 'required|date_format:d M Y',
            'visible_time' => 'required|date_format:g:i A',
            'start_date' => 'required|date_format:d M Y',
            'start_time' => 'required|date_format:g:i A',
            'description' => 'required|string',
            'cover' => 'nullable|file|image|max:307400|mimes:jpg,jpeg,png',
        ]);
    }

    public function destroy(Event $event)
    {
        $this->authorize('acl', 'events.remove');

        $name = $event->name;
        $event->Integreat_party()->delete();
        $event->Languages_event()->delete();
        $event->delete();

        return back()->with(['eventDeleted' => "Event \"$name\" has been deleted."]);
    }
}
