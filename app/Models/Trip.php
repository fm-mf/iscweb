<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trip extends Model
{
    const REGULAR_PARTICIPANT = 1;
    const STAND_IN = 2;
    const TRIP_FULL = 3;

    public $timestamps = true;
    protected $primaryKey = 'id_trip';
    //public $incrementing = false;

    protected $dates = ['registration_from', 'trip_date_to', 'registration_to', 'updated_at', 'created_at'];

    protected $fillable = [

    ];

    public function modifiedBy()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'modified_by');
    }

    public function organizers()
    {
        return $this->belongsToMany('\App\Models\Buddy', 'trips_organizers', 'id_trip', 'id_user')->withTimestamps();
    }

    public function participants()
    {
        return $this->belongsToMany('\App\Models\ExchangeStudent', 'trips_participants', 'id_trip', 'id_user')->withTimestamps();
    }

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_event', 'id_event');
    }

    public function howIsFill()
    {
        return $this->participants()->wherePivot('stand_in', 'n')->count();
    }

    public function freeSpots()
    {
        return $this->capacity - $this->howIsFill();
    }

    public function isFull() {
        return $this->freeSpots() == 0;
    }

    public function standInParticipants()
    {
        return $this->participants()->wherePivot('stand_in','y');
    }

    public function addParticipant($idPart, $allowStandIn = true)
    {
        $standIn = $this->isFull() ? 'y' : 'n';
        if ($standIn == 'y' && !$allowStandIn) {
            return self::TRIP_FULL;
        }
        $this->participants()->attach($idPart, [
            'stand_in' => $standIn,
            'registered_by' => \Auth::id(),
        ]);

        return ($standIn == 'y') ? self::STAND_IN : self::REGULAR_PARTICIPANT;
    }

    public function removeParticipant($idPart)
    {
        $part = ExchangeStudent::find($idPart);
        if($this->isFull())
        {
            $standIn = $this->standInParticipants()->first();
            if(isset($standIn))
            {
                $this->participants()->updateExistingPivot($standIn->id_user, ['stand_in' => 'n']);
            }
        }
        $this->participants()->detach($idPart);
    }

    public static function createTrip($data)
    {
        $event = Event::createEvent($data);
        return DB::transaction(function () use ($data,$event) {

            $trip = new Trip();
            $trip->id_event = $event->id_event;
            $time = $data['registration_time'] ? $data['registration_time'] : "00:00 AM";
            $trip->registration_from = Carbon::createFromFormat('d M Y g:i A', $data['registration_date'] . ' ' . $time);
            $time = $data['tripEnd_time'] ? $data['tripEnd_time'] : "00:00 AM";
            $trip->trip_date_to = Carbon::createFromFormat('d M Y g:i A', $data['tripEnd_date'] . ' ' . $time);
            $trip->capacity = $data['capacity'];
            $trip->price = $data['price'];
            $trip->modified_by = Auth::id();
            $trip->save();
            return $trip;
        });
    }


    public static function findAllUpcoming()
    {
        return Trip::with('modifiedBy.user','event')
            ->join('events', 'events.id_event','trips.id_event')
            ->whereDate('events.datetime_from', '>=', Carbon::today())
            //->whereDate('trip_date_to', '>', Carbon::today())
            ->get();
    }

    public static function findAll()
    {
        return Event::with('modifid_by.user');
    }



}
