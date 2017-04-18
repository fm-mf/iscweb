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
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trip;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Types\Null_;
use Intervention\Image\Facades\Image;

class TripController extends Controller
{
    public function showUpcoming()
    {
        $this->authorize('acl', 'trips.view');
        $visibleTrips = Trip::findAllUpcoming()->sortby('event.datetime_from');
        $oldTrips = Trip::findMaxYearOld()->sortByDesc('event.datetime_from');
        return view('partak.trips.dashboard')->with([
            'visibleTrips' => $visibleTrips,
            'oldTrips' => $oldTrips,
        ]);
    }

    public function showMyTrips()
    {
        return view('partak.trips.mytrips')->with(['myTrips' => Buddy::with('organizedTrips')->find(Auth::id())->organizedTrips ]);
    }

    public function showDetail($id)
    {
        $trip = Trip::with('event', 'participants', 'buddyParticipants')->find($id);
        $this->authorize('view', $trip);
        $particip = $trip->buddyParticipants->merge($trip->participants);
        $organizers = $trip->organizers()->with('person.user')->get();
        return view('partak.trips.detail')->with([
           'trip' => $trip,
            'particip' => $particip,
            'organizers' => $organizers,
        ]);
    }

    public function showDetailPdf($id)
    {
        //$this->authorize('acl', 'trips.view');
        $trip = Trip::with('event', 'buddyParticipants', 'participants')->find($id);
        $this->authorize('view', $trip);

        $particip = $trip->buddyParticipants->merge($trip->participants)->sortby(function ($item){
            return strtolower($item->person->last_name);
        });
        $exBuddy = $trip->type == 'ex+buddy';
        $pdf = PDF::loadView('partak.trips.pdf', [
            'particip' => $particip,
            'trip' => $trip,
            'exBuddy' => $exBuddy,
        ] )->setOptions(['dpi' => 96, 'fontHeightRatio' =>0.7]);

        //return view('partak.trips.pdf')->with([ 'particip' => $particip, 'trip' => $trip]);
        return $pdf->setPaper('a4', 'landscape')->download($trip->event->nameWithoutSpaces() .'_participants.pdf');

    }

    public function showDetailExcel($id)
    {
        //$this->authorize('acl', 'trips.view');
        $trip = Trip::with('event', 'buddyParticipants', 'participants')->find($id);
        $this->authorize('view', $trip);

        $particip = $trip->buddyParticipants->merge($trip->participants)->sortby(function ($item){
            return strtolower($item->person->last_name);
        });
        $excell = Excel::create($trip->event->nameWithoutSpaces() .'_participants', function($excel) use($particip, $trip) {

            $excel->sheet('Participants', function ($sheet) use($particip, $trip) {


                $sheet->loadView('partak.trips.excel', [ 'particip' => $particip, 'trip' => $trip]);//->with([ 'particip' => $particip, 'trip' => $trip]);
            });
        });
        return $excell->download('xls');
    }

    public function confirmAddParticipant($id_trip, $id_part)
    {
        $trip = Trip::find($id_trip);
        $this->authorize('addParticipant', $trip);
        $part = Buddy::with('person.user')->find($id_part);
        if(!isset($part) || $part == null)
        {
            $part = ExchangeStudent::with('person.user')->find($id_part);
            if($part->esn_registered === 'n') return back()->with(['error' => $part->person->getFullName() . ' is not ESN registered']);
        }
        return view('partak.trips.confirmPage')->with([
            'trip' => $trip,
            'part' => $part,
            'diets' => Person::getAllDiets(),
        ]);
    }

    public function addParticipantToTrip(Request $request, $id_trip, $id_part)
    {
        //$this->authorize('acl', 'participant.add');
        $trip = Trip::find($id_trip);
        $this->authorize('addParticipant', $trip);
        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }
        if(! array_key_exists('paid', $data)) $data['paid'] = 0;
        $part = Person::find($id_part);
        $part->update($data);
        $result = $trip->addParticipant($id_part, $data);
        if ($result < 3){
            $successUpdate = $trip->getStatusMessage($result, $part);
            $error = null;
        } else {
            $error = $trip->getStatusMessage($result, $part);
            $successUpdate = null;
        }
        return redirect()->action('Partak\TripController@showDetail', ['id' => $id_trip])
            ->with([
                'successUpdate' => $successUpdate,
                'error' => $error,
                ]);
    }

    public function removeParticipantFromTrip($id_trip, $id_part)
    {
        //$this->authorize('acl', 'participant.remove');
        $trip = Trip::find($id_trip);
        $this->authorize('removeParticipant', $trip);
        $result = $trip->removeParticipant($id_part);
        return back()->with(['removeSuccess' => true]);
    }

    public function showEditForm($id_trip)
    {
        $trip = Trip::with('event')->find($id_trip);
        $this->authorize('edit', $trip);

        $buddies = [];
        foreach(Buddy::with('person')->partak()->get() as $buddy) {
            $buddies[] = ['id_user' => $buddy->id_user, 'name' => $buddy->person->first_name . ' ' . $buddy->person->last_name];
        }

        $organizers = [];
        foreach($trip->organizers()->with('person')->get() as $organizer) {
            $organizers[] = ['id_user' => $organizer->id_user, 'name' => $organizer->person->first_name . ' ' . $organizer->person->last_name];
        }

        JavaScript::put([
            'jsoptions' => ['organizers' => $buddies, 'sorganizers' => $organizers]
        ]);
        return view('partak.trips.edit')->with([
            'trip' => $trip,
            'event' => $trip->event,
            'types' => Trip::getAllTypes(),
        ]);
    }

    public function submitEditForm(Request $request, $id_trip)
    {
        //$this->authorize('acl', 'trips.edit');
        $trip = Trip::with('event')->find($id_trip);
        $this->authorize('edit', $trip);
        $this->tripValidator($request->all())->validate();
        if(isset($trip)){
            $data = [];
            foreach ($request->all() as $key => $value) {
                if ($value) {
                    $data[$key] = $value;
                }
            }
            $data['modified_by'] = Auth::id();
            if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $image_name = $trip->event->id_event . '.' . $file->extension();
                \File::delete(storage_path() . '/app/events/covers/' . $trip->event->cover);
                Image::make($file)->save(storage_path() . '/app/events/covers/' . $image_name);
                $data['cover'] = $image_name;
            }
            $trip->update($data);
            $trip->event->update($data);
            return back()->with(['success' => 'Trip was successfully updated']);
        }
        else {
            return back()->with(['!success' => 'Trip wasn\'t updated']);
        }
    }

    public function showCreateForm()
    {
        $this->authorize('acl', 'trips.add');

        $buddies = [];
        foreach(Buddy::with('person')->partak()->get() as $buddy) {
            $buddies[] = ['id_user' => $buddy->id_user, 'name' => $buddy->person->getFullName()];
        }


        JavaScript::put([
            'jsoptions' => ['organizers' => $buddies, 'sorganizers' => []]
        ]);

        $trip = new Trip();
        $event = new Event();
        $event->cover = null;
        $event->visible_from = Carbon::now();//
        $event->datetime_from = Carbon::now();//
        $trip->registration_from = Carbon::now();//
        $trip->trip_date_to = Carbon::now();//
        return view('partak.trips.Create')->with([
            'trip' => $trip,
            'event' => $event,
            'types' => Trip::getAllTypes(),
            'create' => true,
        ]);
    }

    public function submitCreateForm(Request $request)
    {
        $this->authorize('acl', 'trips.add');
        $this->tripValidator($request->all())->validate();

        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }

        $trip = Trip::createTrip($data);
        $trip = Trip::with('event')->find($trip->id_trip);
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $image_name = $trip->event->id_event . '.' . $file->extension();
            Image::make($file)->save(storage_path() . '/app/events/covers/' . $image_name);
            $trip->event->cover = $image_name;
        }
        $trip->event->save();
        return \Redirect::route('trips.edit',['id_trip' => $trip->id_trip])
            ->with(['success' => 'Trip was successfully created.']);
    }

    protected function tripValidator(array $data)
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
            'description' => 'required',
            'price' => 'required|integer|min:0|max:65535',
            'capacity' => 'required|integer|min:0||max:65535',
            'cover' => 'max:307400|mimes:jpg,jpeg,png',
        ]);
    }

    public function showPaymentDetail($id_event, $id_payment)
    {
        $trip = Trip::with('event')->find($id_event);
        $this->authorize('viewPayment', $trip);
        $part = $trip->participants()->where('id', $id_payment)->first();
        if($part == null){
            $part = $trip->buddyParticipants()->where('id', $id_payment)->first();
        }
        $registerby = Buddy::with('person')->find($part->pivot->registered_by);
        return view('partak.trips.paymentDetail')->with([
            'trip' => $trip,
            'part' => $part,
            'registerby' => $registerby,
        ]);
    }

    public function deleteTrip($id_trip)
    {
        $this->authorize('acl', 'trips.remove');
        $trip = Trip::with('evetn')->find($id_trip);
        $trip->organizers()->detach();
        $trip->participants()->detach();
        $trip->event->delete();
        $trip->delete();
        return back();
    }



}