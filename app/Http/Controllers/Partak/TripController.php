<?php

/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 5.2.17
 * Time: 9:41
 */

namespace App\Http\Controllers\Partak;

use App\Exports\TripParticipantsExport;
use App\Models\Buddy;
use App\Models\Event;
use App\Models\Person;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ReservationCancelledMail;
use App\Models\EventReservation;
use App\Models\EventReservationAnswer;
use App\Models\EventReservationQuestion;
use App\Models\Semester;
use App\Models\Trip;
use App\Models\User;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Laravel\Facades\Image;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TripController extends Controller
{
    public function list()
    {
        $this->authorize('acl', 'trips.view');

        $trips = Trip::getOrderedByTime('DESC')
            ->paginate(20);

        return view('partak.trips.list')->with([
            'trips' => $trips
        ]);
    }


    public function showUpcoming()
    {
        $this->authorize('acl', 'trips.view');

        $visibleTrips = Trip::findAllUpcoming()
            ->paginate(20);

        return view('partak.trips.upcoming')->with([
            'visibleTrips' => $visibleTrips,
        ]);
    }

    public function showMyTrips()
    {
        return view('partak.trips.my')
            ->with([
                'myTrips' => Buddy::with('organizedTrips')
                    ->find(Auth::id())
                    ->organizedTrips()
                    ->join('events', 'trips.id_event', '=', 'events.id_event')
                    ->orderBy('events.datetime_from', 'DESC')
                    ->with('event')
                    ->paginate(20)
            ]);
    }

    public function showDetail($id)
    {
        $trip = Trip::withParticipants(
            'reservations.user',
            'reservations.exchangeStudent',
            'reservations.buddy',
            'reservations.user.person',
            'event',
            'organizers.person',
            'organizers.person.buddy',
            'organizers.person.exchangeStudent'
        )->find($id);

        $this->authorize('view', $trip);

        $particip = $trip->participants;
        $organizers = $trip->organizers;
        $reservations = $trip->reservations;
        $receipt = null;

        return view('partak.trips.detail')->with([
            'trip' => $trip,
            'particip' => $particip,
            'organizers' => $organizers,
            'reservations' => $reservations
        ]);
    }

    public function showDetailPdf($id)
    {
        $trip = Trip::withParticipants('event')->find($id);
        $this->authorize('view', $trip);

        $particip = $trip->participants->sortby(function ($item) {
            return strtolower($item->last_name);
        });
        $exBuddy = $trip->type == 'ex+buddy';
        $pdf = Pdf::loadView('partak.trips.pdf', [
            'particip' => $particip,
            'trip' => $trip,
            'exBuddy' => $exBuddy,
        ])->setOptions(['dpi' => 96, 'fontHeightRatio' => 0.7]);

        //return view('partak.trips.pdf')->with([ 'particip' => $particip, 'trip' => $trip]);
        return $pdf->setPaper('a4', 'landscape')->download($trip->event->nameWithoutSpaces() . '_participants.pdf');
    }

    public function showDetailExcel($id)
    {
        $trip = Trip::withParticipants('event')->find($id);
        $this->authorize('view', $trip);


        //        $participants = $trip->participants()->orderByGivenNames()->get();
        //        return view('partak.trips.excel-participants')->with([
        //            'trip' => $trip,
        //            'participants' => $participants,
        //        ]);

        return new TripParticipantsExport($trip);
    }

    public function confirmAddParticipant($id_trip, $id_part)
    {
        $trip = Trip::find($id_trip);
        $this->authorize('addParticipant', $trip);
        $part = Person::with('user', 'exchangeStudent', 'buddy')->find($id_part);
        $reservation = EventReservation::findByUserAndEvent($id_part, $trip->id_event)->first();

        return view('partak.trips.confirmPage')->with([
            'trip' => $trip,
            'part' => $part,
            'reservation' => $reservation,
            'diets' => Person::getAllDiets(),
        ]);
    }

    public function addParticipantToTrip(Request $request, $id_trip, $id_part)
    {
        $trip = Trip::find($id_trip);

        $this->authorize('addParticipant', $trip);

        $request->validate([
            'payment_method' => ['required', 'payment_method'],
        ]);

        $response = (object) [
            'error' => null,
            'successUpdate' => null,
            'receipt' => null,
        ];

        DB::transaction(function () use ($request, $trip, $id_part, $response) {
            $responseData = [
                'paid' => $request->input('paid', 0),
                'comment' => $request->input('comment'),
                'payment_method' => $request->input('payment_method'),
            ];

            $personData = [];
            if ($request->has('medical_issues')) {
                $personData['medical_issues'] = $request->input('medical_issues');
            }
            if ($request->has('diet')) {
                $personData['diet'] = $request->input('diet');
            }

            $part = Person::find($id_part);
            $part->update($personData);

            $result = $trip->addParticipant($id_part, $responseData);
            if ($result->code < Trip::TRIP_FULL) {
                $response->successUpdate = $trip->getStatusMessage($result->code, $part);
                $response->receipt = $result->receipt->id_receipt;
                $response->error = null;

                if ($trip->event->reservations_enabled) {
                    $reservation = EventReservation::findByUserAndEvent($id_part, $trip->id_event)
                        ->withTrashed()
                        ->first();

                    if (!$reservation) {
                        // Somehow we will not receive primary key here :(
                        $reservation = EventReservation::create([
                            'id_event' => $trip->id_event,
                            'id_user' => $id_part,
                            'deleted_by' => Auth::id()
                        ]);

                        // We have to fetch the reservation to get proper primary key due to weird laravel bug
                        $reservation = EventReservation::findByUserAndEvent($id_part, $trip->id_event)
                            ->withTrashed()
                            ->first();
                        $reservation->delete();
                    }

                    $custom = $request->input('custom');
                    foreach ($trip->questions as $question) {
                        if (isset($custom[$question->id_question])) {
                            $answer = EventReservationAnswer::firstOrCreate([
                                'id_event_reservation' => $reservation->id_event_reservation,
                                'id_question' => $question->id_question
                            ], ['value' => '']);

                            $answer->update([
                                'value' => json_encode($custom[$question->id_question])
                            ]);
                        }
                    }
                }
            } else {
                $response->error = $trip->getStatusMessage($result->code, $part);
                $response->successUpdate = null;
            }
        });

        return redirect()
            ->action('Partak\TripController@showDetail', ['id' => $id_trip])
            ->with((array) $response);
    }

    public function removeReservationFromTrip(int $id_trip, int $id_part)
    {
        /** @var Trip */
        $trip = Trip::find($id_trip);

        if (!$trip) {
            throw new NotFoundHttpException('Trip not found');
        }

        $this->authorize('removeParticipant', $trip);

        /** @var Person */
        $participant = Person::find($id_part);

        if (!$participant) {
            throw new NotFoundHttpException('Participant not found');
        }

        /** @var EventReservation */
        $reservation = EventReservation::findByUserAndEvent($id_part, $trip->id_event)
            ->firstOrFail();

        foreach ($reservation->answers()->get() as $answer) {
            $answer->delete();
        }

        $reservation->update([
            "deleted_by" => Auth::id()
        ]);
        $reservation->save();
        $reservation->delete();

        try {
            Mail::to($reservation->user->email)
                ->send(new ReservationCancelledMail(
                    $reservation,
                    User::find(Auth::id())
                ));
        } catch (\Exception $ex) {
            Log::error("Failed to send email to {$reservation->user->email}");
            Log::error($ex);
        }

        return back()
            ->with(['successUpdate' => $participant->getFullName() . ' was successfully removed.']);
    }

    public function removeParticipantFromTrip($id_trip, $id_part)
    {
        $trip = Trip::find($id_trip);
        $this->authorize('removeParticipant', $trip);
        $result = $trip->removeParticipant($id_part);
        $participant = Person::find($id_part);
        return back()->with(['successUpdate' => $participant->getFullName() . ' was successfully removed.']);
    }

    public function showEditForm($id_trip)
    {
        $trip = Trip::with('event')->find($id_trip);
        $this->authorize('edit', $trip);

        $semesterId = Semester::getCurrentSemester()->id_semester;
        $semesters = Semester::orderBy('id_semester', 'desc')
            ->pluck('semester', 'id_semester');

        $buddies = [];
        foreach (Buddy::with('person')->partak()->get() as $buddy) {
            $buddies[] = ['id_user' => $buddy->id_user, 'name' => $buddy->person->getFullName()];
        }

        $organizers = [];
        foreach ($trip->organizers()->with('person')->get() as $organizer) {
            $organizers[] = ['id_user' => $organizer->id_user, 'name' => $organizer->person->getFullName()];
        }

        JavaScript::put([
            'jsoptions' => [
                'organizers' => $buddies,
                'sorganizers' => $organizers,
                'questions' => $trip->questions()->get()
            ]
        ]);

        return view('partak.trips.edit')->with([
            'trip' => $trip,
            'event' => $trip->event,
            'types' => Trip::getAllTypes(),
            'semesters' => $semesters,
            'currentSemesterId' => $semesterId
        ]);
    }

    public function submitEditForm(Request $request, $id_trip)
    {
        $trip = Trip::with('event')->find($id_trip);
        $this->authorize('edit', $trip);
        $this->tripValidator($request->all())->validate();
        if (isset($trip)) {
            $data = [];
            foreach ($request->all() as $key => $value) {
                if ($value) {
                    $data[$key] = $value;
                }
            }
            $data['modified_by'] = Auth::id();

            if ($request->hasFile('cover')) {
                $trip->event->storeCover($request->file('cover'));
                unset($data['cover']);
            }

            $data['reservations_payment_on_spot'] = $request->input('reservations_payment_on_spot') === '1' ? true : false;
            $data['reservations_enabled'] = $request->input('reservations_enabled') === '1' ? true : false;
            $data['reservations_diet'] = $request->input('reservations_diet') === '1' ? 1 : 0;
            $data['reservations_medical'] = $request->input('reservations_medical') === '1' ? 1 : 0;
            $data['ow'] = $request->input('ow') === '1' ? 1 : 0;

            $trip->update($data);
            $trip->event->update($data);

            $questions = $request->input('questions');
            $this->saveQuestions($trip, is_array($questions) ? $questions : []);

            return back()->with(['success' => 'Trip was successfully updated']);
        } else {
            return back()->with(['!success' => 'Trip wasn\'t updated']);
        }
    }

    public function showCreateForm()
    {
        $this->authorize('acl', 'trips.add');

        $semesterId = Semester::getCurrentSemester()->id_semester;
        $semesters = Semester::orderBy('id_semester', 'desc')
            ->pluck('semester', 'id_semester');

        $buddies = [];
        foreach (Buddy::with('person')->partak()->get() as $buddy) {
            $buddies[] = ['id_user' => $buddy->id_user, 'name' => $buddy->person->getFullName()];
        }

        JavaScript::put([
            'jsoptions' => ['organizers' => $buddies, 'sorganizers' => [], 'questions' => []]
        ]);

        $trip = new Trip();
        $event = new Event();

        $event->cover = null;
        $event->visible_from = Carbon::now();
        $event->datetime_from = Carbon::now();

        $trip->registration_from = Carbon::now();
        $trip->registration_to = Carbon::now();
        $trip->trip_date_to = Carbon::now();
        $trip->event = $event;

        return view('partak.trips.Create')->with([
            'trip' => $trip,
            'event' => $event,
            'types' => Trip::getAllTypes(),
            'create' => true,
            'semesters' => $semesters,
            'currentSemesterId' => $semesterId
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
        $trip->load('event');

        if ($request->hasFile('cover')) {
            $trip->event->storeCover($request->file('cover'));
        }

        $this->saveQuestions($trip, $request->input('questions') ?? []);

        return \Redirect::route('partak.trips.edit', ['id_trip' => $trip->id_trip])
            ->with(['success' => 'Trip was successfully created.']);
    }

    protected function saveQuestions(Trip $trip, array $questions)
    {
        $previous = $trip->questions()->get();
        $removed = [];
        $order = 0;
        foreach ($previous as $q) {
            $removed[(string) $q->id_question] = true;
        }

        foreach ($questions as $id => $data) {
            if (preg_match("/^new-.*/", $id)) {
                $created = new EventReservationQuestion([
                    'id_event' => $trip->id_event,
                    'order' => $order++,
                    'type' => $data['type'],
                    'label' => $data['label'],
                    'description' => $data['description'],
                    'required' => $data['required'],
                    'data' => $data['data']
                ]);
                $created->save();
            } else {
                /** @var EventReservationQuestion $existing */
                $existing = EventReservationQuestion::find($id);
                if ($existing) {
                    $existing->update([
                        'order' => $order++,
                        'type' => $data['type'],
                        'label' => $data['label'],
                        'description' => $data['description'],
                        'required' => $data['required'],
                        'data' => $data['data']
                    ]);
                }

                $removed[(string) $id] = false;
            }
        }

        foreach ($removed as $id => $remove) {
            if ($remove) {
                /** @var EventReservationQuestion $existing */
                $existing = EventReservationQuestion::find($id);
                $existing->delete();
            }
        }
    }

    protected function tripValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'id_semester' => 'required|exists:semesters',
            'location' => 'nullable|string|max:255',
            'location_url' => 'nullable|string|url|max:255',
            'facebook_url' => 'nullable|string|url|max:255',
            'visible_date' => 'required|date_format:d M Y',
            'visible_time' => 'required|date_format:g:i A',
            'registration_date' => 'required|date_format:d M Y',
            'registration_time' => 'required|date_format:g:i A',
            'registration_end_date' => 'required|date_format:d M Y',
            'registration_end_time' => 'required|date_format:g:i A',
            'start_date' => 'required|date_format:d M Y',
            'start_time' => 'required|date_format:g:i A',
            'end_date' => 'required|date_format:d M Y',
            'end_time' => 'required|date_format:g:i A',
            'description' => 'required|string',
            'price' => 'required|integer|min:0|max:65535',
            'capacity' => 'required|integer|min:0||max:65535',
            'cover' => 'nullable|file|image|max:307400|mimes:jpg,jpeg,png',
        ]);
    }

    public function showPaymentDetail($id_event, $id_payment)
    {
        $trip = Trip::with('event')->find($id_event);
        $this->authorize('viewPayment', $trip);
        $part = $trip->participants()->where('id', $id_payment)->first();
        if ($part == null) {
            $part = $trip->buddyParticipants()->where('id', $id_payment)->first();
        }
        $registerby = Buddy::with('person')->find($part->pivot->registered_by);
        $receipt = Receipt::find($part->pivot->id_receipt);

        return view('partak.trips.paymentDetail')->with([
            'trip' => $trip,
            'part' => $part,
            'registerby' => $registerby,
            'receipt' => $receipt,
        ]);
    }

    public function deleteTrip($id_trip)
    {
        $this->authorize('acl', 'trips.remove');
        $trip = Trip::with(['event', 'questions'])->find($id_trip);
        $event = $trip->event;
        $name = $event->name;

        $trip->organizers()->detach();
        $trip->participants()->detach();
        $trip->deletedParticipants()->detach();

        $trip->questions->each(function (EventReservationQuestion $question) {
            $question->answers()->delete();
        });
        $trip->questions()->delete();
        EventReservation::withTrashed()->where('id_event', $trip->id_event)->forceDelete();

        $trip->delete();
        $event->delete();

        return back()->with(['tripDeleted' => "Trip \"$name\" has been deleted."]);
    }

    public function uploadOptionImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $image_name = \uniqid('q-') . '.' . $file->extension();
            Image::read($file)->save(storage_path() . '/app/events/' . $image_name);
            return response()->json(['path' => $image_name], 200);
        } else {
            return response()->json(['error' => 'file parameter is missing'], 400);
        }
    }

    public function duplicate(Trip $trip)
    {
        $this->authorize('acl', 'trips.add');

        $newTrip = $trip->duplicate();

        return redirect()->route('partak.trips.edit', $newTrip)->with([
            'success' => 'Trip was successfully duplicated.',
        ]);
    }
}
