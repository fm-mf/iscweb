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

    protected $fillable = [ 'registration_from', 'trip_date_to', 'registration_to', 'updated_at', 'created_at', 'capacity', 'price', 'modifid_by', 'type'];

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

    public function buddyParticipants()
    {
        return $this->belongsToMany('\App\Models\Buddy', 'trips_participants', 'id_trip', 'id_user')->withTimestamps();
    }

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_event', 'id_event');
    }

    public function howIsFill()
    {
        return $this->participants()->wherePivot('stand_in', 'n')->count() + $this->buddyParticipants()->wherePivot('stand_in', 'n')->count();
    }

    public function howIsFillSimple()
    {
        return $this->howIsfill() .'/'. $this->capacity;
    }

    public function howIsFillWithDetail()
    {
        $result = '';
        if($this->isFull()) $result = $result . '<b>Event is Full</b> ';
        $result = $result . $this->howIsFillSimple();
        if($this->type === 'ex+buddy') $result = $result . ', ExStudents: '. $this->participants()->wherePivot('stand_in', 'n')->count()
            .' / Buddies: '. $this->buddyParticipants()->wherePivot('stand_in', 'n')->count();
        return $result;
    }

    public function howIsFillPercentage()
    {
        if($this->capacity == 0) return 0;
        return ($this->howIsFill() / $this->capacity) * 100;
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

    public function addParticipant($idPart, $data, $allowStandIn = false)
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
        if(! ($this->participants()->find($idPart) || $this->buddyParticipants()->find($idPart)))
        {
            $part = ExchangeStudent::find($idPart);
            if(! isset($part))
            {
                $this->buddyParticipants()->attach($idPart, [
                    'stand_in' => $standIn,
                    'registered_by' => $registeredBy,
                    'paid' => $data['paid'],
                    'comment' => array_key_exists('comment', $data) ? $data['comment'] : null,
                ]);
            }
            else
            {
                $this->participants()->attach($idPart, [
                    'stand_in' => $standIn,
                    'registered_by' => $registeredBy,
                    'paid' => $data['paid'],
                    'comment' => array_key_exists('comment', $data) ? $data['comment'] : null,
                ]);
            }
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

        $toSync = [];
        if (array_key_exists('organizers', $attributes))
        {
            $organizers = $attributes['organizers'];
            if (!is_array($organizers)) {
                $organizers = explode(',', $organizers);
            }
            foreach ($organizers as $organizer) {
                $toSync[$organizer] = ['add_by' => Auth::id()];
            }
        }

        $this->organizers()->sync($toSync);
        if(! array_key_exists('price', $attributes)) $attributes['price'] = 0;
        if(! array_key_exists('capacity', $attributes)) $attributes['capacity'] = 0;
        //dd($attributes);
        return parent::update(self::updateDatetimes($attributes), $options);


    }

    public function isOrganizer($id_user)
    {
        return $this->organizers()->where('trips_organizers.id_user', $id_user)->exists();
    }

    public static function createTrip($data)
    {
        $data = self::updateDatetimes($data);
        $event = Event::createEvent($data);

        $id_user = Auth::id();
        if (!$id_user) $id_user = 4736; //id of office account

        $organizers = array_key_exists('organizers', $data) ? $data['organizers'] : [];
        if (!is_array($organizers)) {
            $organizers = explode(',', $organizers);
        }

        return DB::transaction(function () use ($data, $event, $id_user, $organizers) {

            $trip = new Trip();
            $trip->id_event = $event->id_event;
            $trip->registration_from = $data['registration_from'];
            $trip->trip_date_to = $data['trip_date_to'];
            (array_key_exists('capacity', $data)) ? $trip->capacity = $data['capacity'] : 0;
            (array_key_exists('price', $data)) ? $trip->price = $data['price'] : 0;
            $trip->modified_by = $id_user;
            $trip->save();

            foreach($organizers as $organizer) {
                $trip->organizers()->attach($organizer, ['add_by' => $id_user]);
            }


            return $trip;
        });
    }

    protected static function updateDatetimes($data)
    {
        $time = $data['registration_time'] ? $data['registration_time'] : "00:00 AM";
        //dd($data['registration_date']);
        $data['registration_from'] = Carbon::createFromFormat('d M Y g:i A', $data['registration_date'] . ' ' . $time);
        $time = $data['end_time'] ? $data['end_time'] : "00:00 AM";
        $data['trip_date_to'] = Carbon::createFromFormat('d M Y g:i A', $data['end_date'] . ' ' . $time);
        return $data;
    }


    public static function findAllUpcoming()
    {
        return Trip::with('modifiedBy.user','event')
            ->whereHas('event', function ($query) {
                $query->whereDate('datetime_from', '>=', Carbon::today());
            })->get();
    }
    public static function findMaxYearOld()
    {
        return Trip::with('event')
            ->whereHas('event', function ($query) {
                $query->whereDate('datetime_from', '<', Carbon::today())
                    ->whereDate('datetime_from', '>', Carbon::today()->subYear());
            })->get();
    }


    public static function findAll()
    {
        return Event::with('modifid_by.user');
    }

    public static function getAllTypes()
    {
        $data = \DB::select('describe trips type');
        preg_match('/^enum\((.*)\)$/', $data[0]->Type, $matches);
        foreach( explode(',', $matches[1]) as $value )
        {
            $value = trim( $value, "'" );
            $enum[$value] = $value;
        }
        return $enum;
    }

}
