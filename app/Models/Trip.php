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
    const PARTICIPANT_ALREADY_IN = 4;

    public $timestamps = false;
    protected $primaryKey = 'id_trip';
    //public $incrementing = false;

    protected $dates = ['registration_from', 'trip_date_to', 'registration_to'];

    protected $fillable = [ 'registration_from', 'trip_date_to', 'registration_to', 'capacity', 'price', 'type'];


    public function organizers()
    {
        return $this->belongsToMany('\App\Models\Buddy', 'trips_organizers', 'id_trip', 'id_user')->withTimestamps();
    }

    public function participants()
    {
        return $this->belongsToMany('\App\Models\Person', 'trips_participants', 'id_trip', 'id_user')
            ->withTimestamps()->withPivot('stand_in', 'paid', 'comment', 'registered_by', 'created_at', 'id')
            ->wherePivot('deleted_by', null);
    }

    public function deletedParticipants()
    {
        return $this->belongsToMany('\App\Models\Person', 'trips_participants', 'id_trip', 'id_user')
            ->withTimestamps()->withPivot('stand_in', 'paid', 'comment', 'registered_by', 'created_at', 'id')
            ->wherePivot('deleted_by', '!=', null);
    }

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_event', 'id_event');
    }

    public function howIsFill()
    {
        return $this->participants()->wherePivot('stand_in', 'n')->count();
    }

    public function howIsFillSimple()
    {
        return $this->howIsfill() .'/'. $this->capacity;
    }

    public function howIsFillWithDetail()
    {
        $result = '';
        if ($this->isFull()) $result = $result . '<b>Event is Full</b> ';
        $result = $result . $this->howIsFillSimple();
        if ($this->type === 'ex+buddy') {
            $participats = $this->participants()->with('buddy', 'exchangeStudent')->wherePivot('stand_in', 'n')->get();
            $buddyCount = $participats->filter(function ($value, $key) {
                return isset($value->buddy);
            })->count();
            $result = $result . ', ExStudents: ' . ($participats->count() - $buddyCount) . ' / Buddies: ' . $buddyCount;
        }
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

        $part = $this->participants()->find($idPart);
        $deletePart = $this->deletedParticipants()->find($idPart);
        if(isset($deletePart)) {    //if softDeleted, only update row
            $this->deletedParticipants()->updateExistingPivot($idPart, [
                'deleted_at' => null,
                'deleted_by' => null,
                'stand_in' => $standIn,
                'registered_by' => $registeredBy,
                'paid' => $data['paid'] ?? 0,
                'comment' => $data['comment'] ?? null,
            ]);
        } elseif(! isset($part)) {  //new participant
            $this->participants()->attach($idPart, [
                'stand_in' => $standIn,
                'registered_by' => $registeredBy,
                'paid' => $data['paid'],
                'comment' => $data['comment'] ?? null,
            ]);
        } else {
            return self::PARTICIPANT_ALREADY_IN;
        }

        return ($standIn == 'y') ? self::STAND_IN : self::REGULAR_PARTICIPANT;
    }

    public function removeParticipant($idPart)
    {
        //stand in not supported yet
        /*$part = $this->participants()->withPivot('stand_in')->find($idPart);
        if($this->isFull() && $part->pivot->stand_in == 'n')
        {
            $standIn = $this->standInParticipants()->first();
            if(isset($standIn))
            {
                $this->participants()->updateExistingPivot($standIn->id_user, ['stand_in' => 'n', 'paid' => $this->price]);
            }
        }*/

        //Soft delete
        $this->participants()->updateExistingPivot($idPart, [
            'deleted_at' => Carbon::now(),
            'deleted_by' => Auth::id(),
        ]);
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
        $organizer = $this->organizers->first(function ($value, $key) use($id_user){
            return $value->id_user == $id_user;
        });
        return isset($organizer);
    }

    public function isOpen()
    {
        return $this->registration_from <= Carbon::now()
            && $this->event->datetime_from->addDays(7) >= Carbon::now();
    }

    public function isSignIn($id_user)
    {
        $signIn = Person::where('id_user', $id_user)->whereHas('buddy.trips.event', function ($query) {
            $query->where('name', $this->id_event);
        })->orWhereHas('exchangeStudent.trips.event', function ($query) {
            $query->where('name', 'Flag Parade');
        })->exists();
    }

    public static function withParticipants(... $with)
    {
        return self::with('participants.user', 'participants.exchangeStudent', 'participants.buddy', ...$with);
    }

    public static function createTrip($data)
    {
        $data = self::updateDatetimes($data);
        $event = Event::createEvent($data);

        $id_user = Auth::id();
        if (!$id_user) $id_user = 4736; //id of office account

        $organizers = $data['organizers'] ?? [];
        if (!is_array($organizers)) {
            $organizers = explode(',', $organizers);
        }

        return DB::transaction(function () use ($data, $event, $id_user, $organizers) {

            $trip = new Trip();
            $trip->id_event = $event->id_event;
            $trip->registration_from = $data['registration_from'];
            $trip->trip_date_to = $data['trip_date_to'];
            $trip->capacity = $data['capacity'] ?? 0;
            $trip->price = $data['price'] ?? 0;
            $trip->save();

            foreach($organizers as $organizer) {
                $trip->organizers()->attach($organizer, ['add_by' => $id_user]);
            }

            return $trip;
        });
    }

    protected static function updateDatetimes($data)
    {
        $time = $data['registration_time'] ?? "00:00 AM";
        //dd($data['registration_date']);
        $data['registration_from'] = Carbon::createFromFormat('d M Y g:i A', $data['registration_date'] . ' ' . $time);
        $time = $data['end_time'] ?? "00:00 AM";
        $data['trip_date_to'] = Carbon::createFromFormat('d M Y g:i A', $data['end_date'] . ' ' . $time);
        return $data;
    }


    public static function findAllUpcoming()
    {
        return Trip::with('event')
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
        return Event::get();
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

    public function getStatusMessage($messageCode, $part)
    {
        $partName = $part->first_name . ' ' . $part->last_name;
        switch ($messageCode)
        {
            case self::REGULAR_PARTICIPANT:
                return $partName . ' was successfully add to ' . $this->event->name;
            case self::STAND_IN:
                return $partName . ' was successfully add in to ' . $this->event->name . ' as stand in';
            case self::TRIP_FULL:
                return 'Trip '. $this->event->name . 'is FULL!!!';
            case self::PARTICIPANT_ALREADY_IN:
                return $partName . ' is already in ' . $this->event->name;
        }
    }
}
