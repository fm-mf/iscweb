<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Auth\ProfileController;
use App\Models\Event;
use App\Models\ExchangeStudent;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * To use this script, the client must always provide following fields in the body of the request:
 * - username
 * - password
 * - action
 *
 * Failing to provide any of the fields will result into an error response.
 * Furthermore, the [username] and [password] must match the values below and
 * [action] must be one of 'load', 'register', 'unregister' or 'refresh'
 */
class TripsAppController extends Controller
{

    // PHP credentials, used by client app (such as the android app) to authenticate itself to use this script
    const APP_USERNAME = 'isc';
    const APP_PASSWORD = 'trips999';

    const USERNAME_KEY = 'username';
    const PASSWORD_KEY = 'password';
    const ACTION_KEY = 'action';
    const CARD_NUMBER_KEY = 'card_number';
    const USER_ID_KEY = 'user_id';
    const TRIP_ID_KEY = 'trip_id';

    // Query actions
    const ACTION_PING = 'ping';
    const ACTION_TRIPS = 'trips';
    const ACTION_LOAD = 'load';
    const ACTION_REGISTER = 'register';
    const ACTION_UNREGISTER = 'unregister';
    const ACTION_REFRESH = 'refresh';

    const FIELD_STATUS = 'status';
    const FIELD_DATA = 'data';
    const FIELD_TRIPS = 'trips';
    const FIELD_TYPE = 'type';
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    public function index(Request $request)
    {
        if (!$this->authenticate($request)) {
            return $this->generateErrror(401 /* Unauthorized */, "Invalid credentials.");
        }

        if (!$request->has(self::ACTION_KEY)) {
            return $this->generateErrror(400 /* Bad request */, "Missing action.");
        }

        $action = $request->get(self::ACTION_KEY);
        switch ($action) {
            case self::ACTION_PING:
                return response()->make();
                break;
            case self::ACTION_TRIPS:
                return $this->trips($request);
                break;
            case self::ACTION_LOAD:
                return $this->load($request);
                break;
            case self::ACTION_REGISTER:
                return $this->register($request);
                break;
            case self::ACTION_UNREGISTER:
                return $this->unregister($request);
                break;
            case self::ACTION_REFRESH:
                return $this->refresh($request);
                break;
            default:
                return $this->generateErrror(400 /* Bad request */, "Invalid action '" . $action ."'.");
        }
    }

    public function trips(Request $request)
    {
        // TODO: actually implement full trips request
        return $this->refresh($request);
    }

    public function load(Request $request)
    {
        if (!$request->has(self::CARD_NUMBER_KEY)) {
            return $this->generateErrror(400 /* Bad request */, "Missing card number.");
        }

        $cardNumber = $request->get(self::CARD_NUMBER_KEY);
        $exStudents = ExchangeStudent::where('esn_card_number', $cardNumber);

        if ($exStudents->count() > 1) {
            return $this->generateErrror(500 /* Internal error */, "Card number not unique.");
        }

        if ($exStudents->count() < 1) {
            return $this->generateErrror(400 /* Bad request */, "Card number not registered.");
        }

        $exStudent = ExchangeStudent::where('esn_card_number', $cardNumber)->first();

//        if (!$exStudent) {
//            return $this->generateErrror(self::ERR_CARD);
//        }

        return response()->json([
            self::FIELD_STATUS => self::STATUS_SUCCESS,
            self::FIELD_DATA => [
                'id_user' => $exStudent->id_user,
                'first_name' => $exStudent->person->first_name,
                'last_name' => $exStudent->person->last_name,
                'sex' => $exStudent->person->sex,
                'faculty' => $exStudent->faculty->faculty
            ],
            self::FIELD_TRIPS => $this->loadTrips($exStudent->id_user)
        ]);
    }

    public function register(Request $request)
    {
        if (!$request->has(self::USER_ID_KEY) || !$request->has(self::TRIP_ID_KEY)) {
            return $this->generateErrror(400 /* Bad request */, "Missing user ID or trip ID.");
        }

        $userId = $request->get(self::USER_ID_KEY);
        $tripId = $request->get(self::TRIP_ID_KEY);

        $dbResult = Trip::find($tripId)->addParticipant($userId, false /*allowStandIn*/);
        if ($dbResult == Trip::REGULAR_PARTICIPANT) {
            return response()->json([
                self::FIELD_STATUS => self::STATUS_SUCCESS,
                self::FIELD_DATA => [],
                self::FIELD_TRIPS => $this->loadTrips($userId)
            ]);
        } else {
            // TODO: handle all possible dbResult values
            return $this->generateErrror(500 /* Internal error */, "Internal SQL error.");
        }
    }

    public function unregister(Request $request)
    {
        if (!$request->has(self::USER_ID_KEY) || !$request->has(self::TRIP_ID_KEY)) {
            return $this->generateErrror(400 /* Bad request */, "Missing user ID or trip ID.");
        }

        $userId = $request->get(self::USER_ID_KEY);
        $tripId = $request->get(self::TRIP_ID_KEY);

        $trip = Trip::find($tripId);
        $trip->removeParticipant($userId);

        return response()->json([
            self::FIELD_STATUS => self::STATUS_SUCCESS,
            self::FIELD_DATA => [],
            self::FIELD_TRIPS => $this->loadTrips($userId),
        ]);
    }

    public function refresh(Request $request)
    {
        if (!$request->has(self::USER_ID_KEY)) {
            return $this->generateErrror(400 /* Bad request */, "Missing user ID.");
        }
        $userId = $request->get(self::USER_ID_KEY);

        return response()->json([
            self::FIELD_STATUS => self::STATUS_SUCCESS,
            self::FIELD_DATA => [],
            self::FIELD_TRIPS => $this->loadTrips($userId),
        ]);
    }

    private function loadTrips($userId)
    {
        $result = [];
        $insertTrip = function($trip, $registered) use (&$result) {
            $organizers = "";
            foreach ($trip->organizers as $organizer) {
                $organizers .= ", " . $organizer->person->first_name . ' ' . $organizer->person->last_name;
            }
            if ($organizers != "") {
                $organizers = substr($organizers, 2);
            }

            $dateFrom = $trip->event->datetime_from ? $trip->event->datetime_from->toDateTimeString() : null;
            $dateTo = $trip->trip_date_to ? $trip->trip_date_to->toDateTimeString() : null;

            $result[] = [
                'id_trip' => $trip->id_trip,
                'trip_name' => $trip->event->name,
                'trip_description' => $trip->event->description,
                'trip_organizers' => $organizers,
                'trip_date_from' => $dateFrom,
                'trip_date_to' => $dateTo,
                'trip_capacity' => $trip->capacity,
                'trip_price' => $trip->price,
                'trip_participants' => $trip->howIsFill(),
                'registered' => $registered,
            ];

        };

        $tripsRegistered = Trip::with('organizers')->whereHas('participants', function($query) use($userId) {
            $query->where('people.id_user', $userId);
        })->get();

        foreach ($tripsRegistered as $trip) {
            $insertTrip($trip, 'y');
        }

        $tripsNotRegistered = Trip::with('organizers.person', 'event')
            ->whereHas('event', function ($query) {
                $query->where('datetime_from', '>', Carbon::now('Europe/Prague'))
                    ->where('registration_from', '<=', Carbon::now('Europe/Prague'))
                    ->whereIn('type', array('exchange', 'ex+buddy'));
            })
            ->whereDoesntHave('participants', function($query) use($userId) {
                $query->where('people.id_user', $userId);
            })->get();

        foreach ($tripsNotRegistered as $trip) {
            $insertTrip($trip, 'n');
        }

        return $result;
    }


    private function generateErrror($code, $message)
    {
        http_response_code($code);
        $result = [];
        $result["status_code"] = $code;
        $result["message"] = $message;
        return response()->json($result);
    }

    public function authenticate(Request $request)
    {
        if (!$request->has(self::USERNAME_KEY) ||
            !$request->has(self::PASSWORD_KEY) ||
            $request->get(self::USERNAME_KEY) != self::APP_USERNAME ||
            $request->get(self::PASSWORD_KEY) != self::APP_PASSWORD) {

            return false;
        }

        return true;
    }
}

[
    ''
]

?>