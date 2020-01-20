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
 * [action] must be one of 'ping', 'trips', 'load', 'register', 'unregister' or 'refresh'
 */
class TripsAppController extends Controller
{

    // PHP credentials, used by client app (such as the android app) to authenticate itself to use this script
    const APP_USERNAME = 'isc';
    const APP_PASSWORD = 'trips999';

    // Keys in requests
    const USERNAME_KEY = 'username';
    const PASSWORD_KEY = 'password';
    const ACTION_KEY = 'action';
    const CARD_NUMBER_KEY = 'card_number';
    const USER_ID_KEY = 'user_id';
    const TRIP_ID_KEY = 'trip_id';

    // Action key enum
    const ACTION_PING = 'ping';
    const ACTION_TRIPS = 'trips';
    const ACTION_LOAD = 'load';
    const ACTION_REGISTER = 'register';
    const ACTION_UNREGISTER = 'unregister';
    const ACTION_REFRESH = 'refresh';

    public function index(Request $request)
    {
        if (!$this->authenticate($request)) {
            return $this->generateError(401 /* Unauthorized */, "Invalid credentials.");
        }

        if (!$request->has(self::ACTION_KEY)) {
            return $this->generateError(400 /* Bad request */, "Missing action.");
        }

        $action = $request->get(self::ACTION_KEY);
        switch ($action) {
            case self::ACTION_PING:
                return $this->ping($request);
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
                return $this->generateError(400 /* Bad request */, "Invalid action '" . $action ."'.");
        }
    }


    /**
     * Return an empty response.
     * Used to check whether client has correct auth credentials.
     */
    public function ping(Request $request)
    {
        return response()->json();
    }

    /**
     * Returns list of all the trips WITHOUT information about specific user.
     */
    public function trips(Request $request)
    {
        return response()->json($this->loadTrips());
    }

    /**
     * Returns list of all the trips WITH information about specified user.
     */
    public function load(Request $request)
    {
        if (!$request->has(self::CARD_NUMBER_KEY)) {
            return $this->generateError(400 /* Bad request */, "Missing card number.");
        }

        $cardNumber = $request->get(self::CARD_NUMBER_KEY);
        $exStudents = ExchangeStudent::where('esn_card_number', $cardNumber);

        if ($exStudents->count() > 1) {
            return $this->generateError(500 /* Internal error */, "Card number not unique.");
        }

        if ($exStudents->count() < 1) {
            return $this->generateError(400 /* Bad request */, "Card number not registered.");
        }

        $exStudent = ExchangeStudent::where('esn_card_number', $cardNumber)->first();

        $user = [
            'id_user' => $exStudent->id_user,
            'first_name' => $exStudent->person->first_name,
            'last_name' => $exStudent->person->last_name,
            'sex' => $exStudent->person->sex,
            'esn_card_number' => $cardNumber,
            'faculty' => $exStudent->faculty->faculty
        ];

        return $this->generateResponse($user, $exStudent->id_user);
    }

    /**
     * Registers specified user at the specified trip.
     */
    public function register(Request $request)
    {
        if (!$request->has(self::USER_ID_KEY) || !$request->has(self::TRIP_ID_KEY)) {
            return $this->generateError(400 /* Bad request */, "Missing user ID or trip ID.");
        }

        $userId = $request->get(self::USER_ID_KEY);
        $tripId = $request->get(self::TRIP_ID_KEY);

        $dbResult = Trip::find($tripId)->addParticipant($userId, false /*allowStandIn*/);
        if ($dbResult == Trip::REGULAR_PARTICIPANT) {
            return $this->generateResponse(null, $userId);
        } else {
            // TODO: handle all possible dbResult values
            return $this->generateError(500 /* Internal error */, "Internal SQL error.");
        }
    }

    /**
     * Registers specified user from the specified trip.
     */
    public function unregister(Request $request)
    {
        if (!$request->has(self::USER_ID_KEY) || !$request->has(self::TRIP_ID_KEY)) {
            return $this->generateError(400 /* Bad request */, "Missing user ID or trip ID.");
        }

        $userId = $request->get(self::USER_ID_KEY);
        $tripId = $request->get(self::TRIP_ID_KEY);

        $trip = Trip::find($tripId);
        $trip->removeParticipant($userId);

        return $this->generateResponse(null, $userId);
    }

    /**
     * Registers specified user from the specified trip.
     */
    public function refresh(Request $request)
    {
        if (!$request->has(self::USER_ID_KEY)) {
            return $this->generateError(400 /* Bad request */, "Missing user ID.");
        }
        $userId = $request->get(self::USER_ID_KEY);

        return $this->generateResponse(null, $userId);
    }

    /**
     * Similar to [loadTripsForUser], but doesn't return information about whether a user is registered
     */
    private function loadTrips()
    {
        $result = [];
        $appendTrip = function($trip) use (&$result) {
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
            ];
        };

        // Display only trips that has not passed yet and registrations are opened.
        $trips = Trip::with('organizers.person', 'event')
            ->whereHas('event', function ($query) {
                $query->where('datetime_from', '>', Carbon::now('Europe/Prague'))
                    ->where('registration_from', '<=', Carbon::now('Europe/Prague'))
                    ->whereIn('type', array('exchange', 'ex+buddy'));
            })->get();


        foreach ($trips as $trip) {
            $appendTrip($trip);
        }

        return $result;
    }


    /**
     * Similar to [loadTrips], but also includes information about whether the user is registered or not
     */
    private function loadTripsForUser($userId)
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
                'reserved' => 'y'
            ];
        };

        // Display all the trips that the student has registered to, even if the events already passed.
        $tripsRegistered = Trip::with('organizers')
            ->whereHas('participants', function($query) use($userId) {
                $query->where('people.id_user', $userId);
            })->get();

        foreach ($tripsRegistered as $trip) {
            $insertTrip($trip, 'y');
        }

        // Display only trips that has not passed yet and registrations are opened.
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


    /**
     * Generates standard success result with list of trips and optional user data
     */
    private function generateResponse($user, $userId)
    {
        $response = [];
        $response['user'] = $user;
        $response['trips'] = $this->loadTripsForUser($userId);
        return response()->json($response);
    }

    /**
     * Generates an error and sets http response code
     */
    private function generateError($code, $message)
    {
        $result = [];
        $result["status_code"] = $code;
        $result["message"] = $message;
        return response()->json($result, $code);
    }

    /**
     * Verifies that the client is authenticated to use this script. We depend only on unhashed username/password
     * combination that may be leaked to exchange students etc.
     * TODO: Do better authentication
     */
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