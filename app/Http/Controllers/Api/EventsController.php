<?php

namespace App\Http\Controllers\Api;

use App\Events\StudentReservedSpot;
use App\Facades\Settings;
use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Http\Controllers\Controller;
use App\Http\Resources\TripAuthUserResource;
use App\Models\Event;
use App\Models\EventReservation;
use App\Models\EventReservationAnswer;
use App\Models\Person;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventsController extends Controller
{
    use AuthenticatesUsers;

    public function getExchangeStudent(Request $request)
    {
        $event = $this->getEvent((string)$request->input('event'));
        $student = null;

        $data = $request->validate([
            'esn' => 'string|required',
            'email' => $event->ow ? 'string|nullable' : 'string|required'
        ]);

        try {
            /** @var ExchangeStudent */
            $student = ($event->ow
                ? ExchangeStudent::findByEsn($data['esn'])
                : ExchangeStudent::findByEmailAndEsn($data['email'], $data['esn'])
            )->firstOrFail();
        } catch (\Exception $e) {
            throw new NotFoundHttpException('Invalid e-mail and ESN card number combination');
        }

        $this->checkEventUser($event, $student->id_user);

        return response()->json(new TripAuthUserResource($student->user));
    }

    public function createReservation(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'int|required',
            'event' => 'string|required'
        ]);

        $id_user = (int)$data['id_user'];
        $user = User::where('id_user', '=', $id_user)->firstOrFail();
        $event = $this->getEvent($data['event']);

        $this->checkEventUser($event, $id_user);

        // Get soft deleted reservation if exists
        /** @var EventReservation|null */
        $reservation = EventReservation::findByUserAndEvent($id_user, $event->id_event)
            ->withTrashed()
            ->first();

        // Build new reservation if there's no soft deleted one
        if (!$reservation) {
            $reservation = new EventReservation();
            $reservation->id_event = $event->id_event;
            $reservation->id_user = $user->id_user;
        } else {
            $reservation->deleted_by = null;
            $reservation->deleted_at = null;
        }

        $reservation->expires_at = (new Carbon())
            ->now()
            ->addDays($event->reservations_removal_limit)
            ->setTime(0, 0);
        $reservation->save();

        return response()->json($reservation);
    }

    public function confirmReservation(Request $request)
    {
        $data = $request->validate([
            'event' => 'string|required',
            'id_user' => 'int|required',
            'diet' => 'string|nullable',
            'medical_issues' => 'string|nullable',
            'notes' => 'string|nullable'
        ]);
        $user = User::where('id_user', '=', $data['id_user'])->firstOrFail();
        $event = $this->getEvent($data['event']);

        /** @var EventReservation */
        $reservation = EventReservation::findByUserAndEvent($user->id_user, $event->id_event)
            ->firstOrFail();

        $reservation->update($data);

        // Clear previous anwsers
        foreach ($reservation->answers as $answer) {
            $answer->delete();
        }

        // Create new anwsers
        $custom = $request->input('custom');
        foreach ($event->questions()->get() as $question) {
            if (isset($custom[$question->id_question])) {
                $value = new EventReservationAnswer([
                    'id_event_reservation' => $reservation->id_event_reservation,
                    'id_question' => $question->id_question,
                    'value' => json_encode($custom[$question->id_question])
                ]);
                $value->save();
            }
        }

        // Save personal data
        $personData = [];
        if ($request->has('medical_issues')) {
            $personData['medical_issues'] = $request->input('medical_issues');
        }
        if ($request->has('diet')) {
            $personData['diet'] = $request->input('diet');
        }
        $part = Person::find($user->id_user);
        $part->update($personData);

        return response()->json($reservation);
    }

    public function deleteReservation(Request $request)
    {
        /** @var EventReservation */
        $reservation = EventReservation::findByHash($request->route('hash'));

        if (!$reservation) {
            throw new NotFoundHttpException("Reservation not found");
        }

        $reservation->update([
            "deleted_by" => $reservation->id_user
        ]);
        $reservation->save();
        $reservation->delete();

        return response()->make();
    }

    /**
     * @return Event
     */
    private function getEvent(string $hash)
    {
        try {
            return Event::findByHashWithReservation($hash)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            throw new NotFoundHttpException('Uknown trip');
        }
    }

    private function checkEventUser(Event $event, int $id_user)
    {
        if ($event->trip->hasUser($id_user)) {
            throw new HttpException(400, 'You are already registered for this event');
        }

        if (Settings::get('owTripsRestricted') && $event->ow && $event->trip->hasOwReservation($id_user)) {
            throw new HttpException(400, 'You are already registered to different Orientation Week trip');
        }

        $error = $event->trip->canRegister();
        if ($error !== true) {
            throw new HttpException(400, $error);
        }
    }

    private function responseValidator(array $data)
    {
        return Validator::make($data, [
            'id_user' => 'int|required',
            'diet' => 'in:Vegetarian,Vegan,Fish only|nullable',
            'medical_issues' => 'string|max:1024|nullable',
            'notes' => 'string|max:1024|nullable'
        ]);
    }

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        $event = $this->getEvent((string)$request->input('event'));
        $details = User::with('person')->where('id_user', $this->guard()->user()->id_user)->first();

        $this->checkEventUser($event, $this->guard()->user()->id_user);

        return response()->json(new TripAuthUserResource($details));
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['password'] = User::encryptPassword($credentials[$this->username()], $credentials['password']);
        return $credentials;
    }
}
