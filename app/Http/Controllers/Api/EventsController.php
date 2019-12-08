<?php

namespace App\Http\Controllers\Api;

use App\Events\StudentReservedSpot;
use App\Models\Buddy;
use App\Models\ExchangeStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventReservation;
use App\Models\EventReservationAnswer;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

        try {
            $student = ExchangeStudent::findByEmailAndEsn(
                $request->input('email'),
                $request->input('esn')
            )->firstOrFail();
        } catch (\Exception $e) {
            throw new NotFoundHttpException('Invalid e-mail and ESN card number combination');
        }

        $this->checkEventUser($event, $student->id_user);

        return response()->json($student);
    }

    public function createReservation(Request $request)
    {
        $this->responseValidator($request->all())->validate();

        $id_user = (int)$request->input('id_user');
        $user = User::find($id_user)->firstOrFail();
        $event = $this->getEvent((string)$request->input('event'));

        $this->checkEventUser($event, $id_user);

        // Remove soft deleted reservation if exists
        /** @var EventReservation|null */
        $softDeletedResponse = EventReservation::findByUserAndEvent($id_user, $event->id_event)
            ->withTrashed()
            ->first();
        
        if ($softDeletedResponse) {
            $softDeletedResponse->forceDelete();
        }

        // Build new reservation
        $response = new EventReservation();
        $response->id_event = $event->id_event;
        $response->id_user = $id_user;
        $response->medical_issues = $request->input('medical_issues');
        $response->diet = $request->input('diet');
        $response->notes = $request->input('notes');
        $response->expires_at = (new Carbon())
            ->now()
            ->addDays($event->reservations_removal_limit)
            ->setTime(0, 0);
        $response->save();

        $custom = $request->input('custom');
        foreach ($event->questions()->get() as $question) {
            if (isset($custom[$question->id_question])) {
                $value = new EventReservationAnswer([
                    'id_event' => $event->id_event,
                    'id_user' => $id_user,
                    'id_question' => $question->id_question,
                    'value' => json_encode($custom[$question->id_question])
                ]);
                $value->save();
            }
        }

        event(new StudentReservedSpot($response));

        return response()->json($response);
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
            return Event::findByHash($hash)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            throw new NotFoundHttpException('Uknown trip');
        }
    }

    private function checkEventUser(Event $event, int $id_user)
    {
        if ($event->trip->hasUser($id_user)) {
            throw new HttpException(400, 'You are already registered for this event');
        }

        if ($event->trip->isFull()) {
            throw new HttpException(400, 'Event is already full, sorry :(');
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

        return response()->json($details);
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['password'] = User::encryptPassword($credentials[$this->username()], $credentials['password']);
        return $credentials;
    }
}
