<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Auth\ProfileController;
use App\Models\Event;
use App\Models\ExchangeStudent;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TripsAppController extends Controller
{
    const APP_USERNAME = 'isc';
    const APP_PASSWORD = 'trips999';

    const USERNAME_KEY = 'username';
    const PASSWORD_KEY = 'password';
    const ACTION_KEY = 'action';
    const CARD_NUMBER_KEY = 'card_number';
    const USER_ID_KEY = 'user_id';
    const TRIP_ID_KEY = 'trip_id';

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

    const ERR_AUTHENTICATION = 'AUTH';
    const ERR_DATABASE = 'DB';
    const ERR_INTERNAL = 'INTERNAL';
    const ERR_CARD = 'CARD';

    public function index(Request $request)
    {


        if (!$this->authenticate($request)) {
            return $this->generateErrror(self::ERR_AUTHENTICATION);
        }

        if (!$request->has(self::ACTION_KEY)) {
            return $this->generateErrror(self::ERR_INTERNAL);
        }

        switch ($request->get(self::ACTION_KEY)) {
            case self::ACTION_LOAD :
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
                return $this->generateErrror(self::ERR_INTERNAL);
        }
    }

    public function load(Request $request)
    {
        if (!$request->has(self::CARD_NUMBER_KEY)) {
            return $this->generateErrror(sefl::ERR_CARD);
        }

        $cardNumber = $request->get(self::CARD_NUMBER_KEY);
        $exStudent = ExchangeStudent::where('esn_card_number', $cardNumber)->first();

        if (!$exStudent) {
            return $this->generateErrror(sefl::ERR_CARD);
        }

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
            return $this->generateErrror(self::ERR_INTERNAL);
        }

        $userId = $request->get(self::USER_ID_KEY);
        $tripId = $request->get(self::TRIP_ID_KEY);

        $trip = Trip::find($tripId);
        if ($trip->addParticipant($userId, false /*allowStandIn*/) == Trip::REGULAR_PARTICIPANT) {
            return response()->json([
                self::FIELD_STATUS => self::STATUS_SUCCESS,
                self::FIELD_DATA => [],
                self::FIELD_TRIPS => $this->loadTrips($userId)
            ]);
        } else {
            return $this->generateErrror(self::ERR_INTERNAL);
        }
    }

    public function unregister(Request $request)
    {
        if (!$request->has(self::USER_ID_KEY) || !$request->has(self::TRIP_ID_KEY)) {
            return $this->generateErrror(self::ERR_INTERNAL);
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
            return $this->generateErrror(self::ERR_INTERNAL);
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
        $trips = Trip::whereHasNot('participants', function($query) use($userId) {
            $query->where('id_user', $userId);
        });

        $result = [];
        foreach ($trips as $trip) {
            $result[] = [
                'id_trip' => $trip->id_trip,
                'trip_name' => $trip->trip_name,
                'trip_description' => $trip->trip_description
            ];
        }

        return $result;
    }


    private function generateErrror($type)
    {
        $result = [];
        $result[self::FIELD_STATUS] = self::STATUS_ERROR;
        $result[self::FIELD_TYPE] = $type;
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