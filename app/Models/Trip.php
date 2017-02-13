<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Trip extends Model
{
    const REGULAR_PARTICIPANT = 1;
    const STAND_IN = 2;
    const TRIP_FULL = 3;

    public $timestamps = true;
    protected $primaryKey = 'id_trip';
    //public $incrementing = false;

    protected $dates = ['registration_from', 'trip_date_to', 'registration_to', 'updated_at', 'created_at'];

    protected $fillable = [ 'registration_from', 'trip_date_to', 'registration_to', 'updated_at', 'created_at', 'capacity', 'price', 'modifid_by'];

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

        if (Auth::id()) {
            $registeredBy = Auth::id();
        } else {
            $registeredBy = 464;
        }

        if(! $this->participants()->find($idPart))
        {
            $this->participants()->attach($idPart, [
                'stand_in' => $standIn,
                'registered_by' => $registeredBy,
                'paid' => $standIn == 'y' ? 0 : $this->price,
            ]);
        }

        return ($standIn == 'y') ? self::STAND_IN : self::REGULAR_PARTICIPANT;
    }

    public function removeParticipant($idPart)
    {
        $part = $this->participants()->withPivot('stand_in')->find($idPart);
        if($this->isFull() && $part->pivot->stand_in == 'n')
        {
            $standIn = $this->standInParticipants()->first();
            if(isset($standIn))
            {
                $this->participants()->updateExistingPivot($standIn->id_user, ['stand_in' => 'n', 'paid' => $this->price]);
            }
        }
        $this->participants()->detach($idPart);
    }

    public function update(array $attributes = [], array $options = [])
    {
        return parent::update(self::updateDatetimes($attributes), $options);
    }

    public static function createTrip($data)
    {
        $data = updateDatetimes($data);
        $event = Event::createEvent($data);
        $id_user = Auth::id();
        return DB::transaction(function () use ($data, $event, $id_user) {

            $trip = new Trip();
            $trip->id_event = $event->id_event;
            $trip->registration_from = $data['registration_from'];
            $trip->trip_date_to = $data['trip_date_to'];
            $trip->capacity = $data['capacity'];
            $trip->price = $data['price'];
            $trip->modifid_by = $id_user;
            $trip->save();
            return $trip;
        });
    }

    protected static function updateDatetimes($data)
    {
        $time = $data['registration_time'] ? $data['registration_time'] : "00:00 AM";
        $data['registration_from'] = Carbon::createFromFormat('d M Y g:i A', $data['registration_date'] . ' ' . $time);
        $time = $data['end_time'] ? $data['end_time'] : "00:00 AM";
        $data['trip_date_to'] = Carbon::createFromFormat('d M Y g:i A', $data['end_date'] . ' ' . $time);
        return $data;
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
