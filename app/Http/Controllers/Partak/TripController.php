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

class TripController extends Controller
{
    public function showUpcoming()
    {
        $this->authorize('acl', 'trips.view');
        $visibleTrips = Trip::findAllUpcoming();
        //dd($visibleTrips);
        return view('partak.trips.dashboard')->with(['visibleTrips' => $visibleTrips,]);
    }

    public function showMyTrips()
    {
        return view('partak.trips.mytrips')->with(['myTrips' => Buddy::with('organizedTrips')->find(Auth::id())->organizedTrips ]);
    }

    public function showDetail($id)
    {
        $trip = Trip::with('event')->find($id);
        $this->authorize('view', $trip);
        if($trip->buddy === 'true'){
            $particip = $trip->buddyParticipants()->with('person.user')->get();
            $url = 'api/autocomplete/buddies';
            $buddy = true;
        }
        else {
            $particip = $trip->participants()->with('person.user')->get();
            $url = 'api/autocomplete/exchange-students';
            //dd($particip);
            $buddy = false;
        }
        //dd($trip->participants()->with('person.user')->get());
        $organizers = $trip->organizers()->with('person.user')->get();
        return view('partak.trips.detail')->with([
           'trip' => $trip,
            'particip' => $particip,
            'organizers' => $organizers,
            'buddy' => $buddy,
        ]);
    }

    public function showDetailPdf($id)
    {
        //$this->authorize('acl', 'trips.view');
        $trip = Trip::with('event')->find($id);
        $this->authorize('view', $trip);


        $particip = $trip->participants()->with('person.user')->get()->sortby(function ($item){
            return strtolower($item->person->last_name);
        });

        $pdf = PDF::loadView('partak.trips.pdf', [ 'particip' => $particip, 'trip' => $trip] )->setOptions(['dpi' => 96, 'fontHeightRatio' =>0.7]);

        //return view('partak.trips.pdf')->with([ 'particip' => $particip, 'trip' => $trip]);
        return $pdf->setPaper('a4', 'landscape')->download($trip->event->nameWithoutSpaces() .'_participants.pdf');

    }

    public function showDetailExcel($id)
    {
        //$this->authorize('acl', 'trips.view');
        $trip = Trip::with('event')->find($id);
        $this->authorize('view', $trip);

        $particip = $trip->participants()->with('person.user')->get()->sortby(function ($item){
            return strtolower($item->person->last_name);
        });
        $excell = Excel::create($trip->event->nameWithoutSpaces() .'_participants', function($excel) use($particip, $trip) {

            $excel->sheet('First sheet', function ($sheet) use($particip, $trip) {


                $sheet->loadView('partak.trips.pdf')->with([ 'particip' => $particip, 'trip' => $trip]);
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
        return redirect()->action('Partak\TripController@showDetail', ['id' => $id_trip]);
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
        //$this->authorize('acl', 'trips.edit');
        //$this->authorize('acl', 'trips');
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
            $trip->update($data);
            $trip->event->update($data);
            return back()->with(['success' => 'Trip was updated successfully']);
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
            $buddies[] = ['id_user' => $buddy->id_user, 'name' => $buddy->person->first_name . ' ' . $buddy->person->last_name];
        }


        JavaScript::put([
            'jsoptions' => ['organizers' => $buddies, 'sorganizers' => []]
        ]);

        $trip = new Trip();
        $event = new Event();
        $event->visible_from = Carbon::now();//
        $event->datetime_from = Carbon::now();//
        $trip->registration_from = Carbon::now();//
        $trip->trip_date_to = Carbon::now();//
        return view('partak.trips.Create')->with([
            'trip' => $trip,
            'event' => $event
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
        return \Redirect::route('trips.edit',['id_trip' => $trip->id_trip]);
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
            'price' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:0',
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