<?php

namespace App\Models;

use App\Facades\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id_trip
 * @property int $id_event
 * @property Carbon $trip_date_to
 * @property Carbon $registration_from
 * @property Carbon $registration_to
 * @property int $capacity
 * @property string $type
 * @property \App\Models\Event $event
 * @property \App\Models\EventReservationQuestion $questions[]
 */
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

    protected $fillable = [
        'registration_from', 'trip_date_to', 'registration_to',
        'capacity', 'price', 'type'
    ];


    public function organizers()
    {
        return $this->belongsToMany('\App\Models\Buddy', 'trips_organizers', 'id_trip', 'id_user')->withTimestamps();
    }

    public function questions()
    {
        return $this->hasMany('\App\Models\EventReservationQuestion', 'id_event', 'id_event')->orderBy('order');
    }

    public function participants()
    {
        return $this->belongsToMany('\App\Models\Person', 'trips_participants', 'id_trip', 'id_user')
            ->withTimestamps()->withPivot('stand_in', 'paid', 'comment', 'registered_by', 'created_at', 'id')
            ->wherePivot('deleted_at', null);
    }

    public function reservations()
    {
        return $this->belongsToMany('\App\Models\Person', 'event_reservations', 'id_event', 'id_user', 'id_event')
            ->withTimestamps()->withPivot('medical_issues', 'diet', 'notes', 'created_at')
            ->wherePivot('deleted_at', null);
    }

    public function deletedParticipants()
    {
        return $this->belongsToMany('\App\Models\Person', 'trips_participants', 'id_trip', 'id_user')
            ->withTimestamps()->withPivot('stand_in', 'paid', 'comment', 'registered_by', 'created_at', 'id')
            ->wherePivot('deleted_at', '!=', null);
    }

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_event', 'id_event');
    }

    public function howIsFill()
    {
        return $this->participants()->wherePivot('stand_in', 'n')->count()
            + $this->reservations()->count();
    }

    public function howIsFillSimple()
    {
        return $this->howIsfill() .'/'. $this->capacity;
    }

    public function buddyParticipants()
    {
        $participats = $this->participants()->with('buddy', 'exchangeStudent')->wherePivot('stand_in', 'n')->get();
        return $participats->filter(function ($value, $key) {
            return isset($value->buddy);
        });
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
        return max(0, $this->capacity - $this->howIsFill());
    }

    public function isFull()
    {
        return $this->freeSpots() <= 0;
    }

    public function canRegister()
    {
        if ($this->isFull()) {
            return 'The trip is full, sorry :(';
        }

        if ($this->event->ow && !Settings::get('owTripsEnabled')) {
            return 'Registrations will start during the Trips presentation in the Orientation Week';
        }

        if ($this->registration_from && $this->registration_from->isAfter(Carbon::now())) {
            return 'Registrations didn\'t start yet';
        }

        if ($this->registration_to && $this->registration_to->isBefore(Carbon::now())) {
            return 'Sorry, registrations already ended';
        }

        return true;
    }

    /**
     * Returns if specified user already has reservation
     * or is registered at any OW trip for current semester.
     */
    public function hasOwReservation(int $id_user)
    {
        // We only match current semester events
        $semesterId = Semester::getCurrentSemester()->id_semester;

        // Find valid reservation
        $reservation = EventReservation::whereHas('event', function (Builder $query) use ($semesterId) {
                $query->where('ow', true)
                    ->where('id_semester', $semesterId);
            })
            ->where('id_user', $id_user)
            ->first();

        // Find valid registration
        $registration = Trip::whereHas('event', function (Builder $query) use ($semesterId) {
                $query->where('ow', true)
                    ->where('id_semester', $semesterId);
            })
            ->whereHas('participants', function (Builder $query) use ($id_user) {
                $query->where('trips_participants.id_user', $id_user);
            })
            ->first();

        return $reservation !== null || $registration !== null;
    }

    public function standInParticipants()
    {
        return $this->participants()->wherePivot('stand_in','y');
    }

    public function addParticipant($userId, $data, $allowStandIn = false)
    {
        $prereg = EventReservation::findByUserAndEvent($userId, $this->id_event);

        if ($prereg) {
            $prereg->delete();
        }

        $standIn = $this->isFull() ? 'y' : 'n';
        if ($standIn == 'y' && !$allowStandIn) {
            return self::TRIP_FULL;
        }

        if (Auth::id()) {
            $registeredBy = Auth::id();
        } else {
            $registeredBy = 464;
        }

        $part = $this->participants()->find($userId);
        $deletePart = $this->deletedParticipants()->find($userId);
        if(isset($deletePart)) {    //if softDeleted, only update row
            $this->deletedParticipants()->updateExistingPivot($userId, [
                'deleted_at' => null,
                'deleted_by' => null,
                'stand_in' => $standIn,
                'registered_by' => $registeredBy,
                'paid' => $data['paid'] ?? 0,
                'comment' => $data['comment'] ?? null,
            ]);
        } elseif(! isset($part)) {  //new participant
            $this->participants()->attach($userId, [
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
            && $this->trip_date_to >= Carbon::now();
    }

    public function isSignIn($id_user): bool
    {
        return Person::where('id_user', $id_user)->whereHas('buddy.trips.event', function ($query) {
            $query->where('name', $this->id_event);
        })->orWhereHas('exchangeStudent.trips.event', function ($query) {
            $query->where('name', 'Flag Parade');
        })->exists();
    }

    public static function withParticipants(... $with)
    {
        return self::with('participants.user', 'participants.exchangeStudent', 'participants.buddy', ...$with);
    }

    public function answers(int $id_user)
    {
        $reservations = EventReservation::findByUserAndEvent($id_user, $this->id_event)
            ->withTrashed()
            ->first();

        return empty($reservations) ? [] : $reservations->answers()->get();
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
            $trip->registration_to = $data['registration_to'];
            $trip->trip_date_to = $data['trip_date_to'];
            $trip->capacity = $data['capacity'] ?? 0;
            $trip->price = $data['price'] ?? 0;
            $trip->type = $data['type'];
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
        $data['registration_from'] = Carbon::createFromFormat('d M Y g:i A', $data['registration_date'] . ' ' . $time);
        $time = $data['registration_end_time'] ?? "00:00 AM";
        $data['registration_to'] = Carbon::createFromFormat('d M Y g:i A', $data['registration_end_date'] . ' ' . $time);
        $time = $data['end_time'] ?? "00:00 AM";
        $data['trip_date_to'] = Carbon::createFromFormat('d M Y g:i A', $data['end_date'] . ' ' . $time);
        return $data;
    }

    public function eventDateInterval($style = true)
    {
        $from = $this->event->datetime_from;
        $to = $this->trip_date_to;
        $same = $from->isSameDay($to);

        $result = $this->formatDateTime($from);

        if ($same) {
            $result .= ' - ' . $this->formatTime($to);
        } else {
            $result .= ($style ? ' <span class="to">to</span> ' : ' to ') . $this->formatDateTime($to);
        }

        return $result;
    }

    private function formatDateTime(Carbon $datetime)
    {
        return $this->formatDate($datetime) . ', ' . $this->formatTime($datetime);
    }

    private function formatDate(Carbon $datetime)
    {
        $time = $datetime->format('l') . ', ';
        $time .= $datetime->format('F') . ' ';
        $time .= $datetime->format('jS');
        return $time;
    }

    private function formatTime(Carbon $datetime)
    {
        $time = $datetime->format('g');

        if ($datetime->minute == 0) {
            $time .= $datetime->format('a');
        } else {
            $time .= $datetime->format(':ia');
        }

        return $time;
    }

    public static function findAllUpcoming()
    {
        return Trip::with('event')
            ->whereHas('event', function ($query) {
                $query->whereDate('trip_date_to', '>=', Carbon::today());
            })->get();
    }
    public static function findMaxYearOld()
    {
        return Trip::with('event')
            ->whereHas('event', function ($query) {
                $query->whereDate('trip_date_to', '<', Carbon::today())
                    ->whereDate('trip_date_to', '>', Carbon::today()->subYear());
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
                return $partName . ' was successfully added to ' . $this->event->name;
            case self::STAND_IN:
                return $partName . ' was successfully added in to ' . $this->event->name . ' as stand in';
            case self::TRIP_FULL:
                return 'Trip '. $this->event->name . 'is FULL!!!';
            case self::PARTICIPANT_ALREADY_IN:
                return $partName . ' is already in ' . $this->event->name;
        }
    }

    public function hasUser($id_user)
    {
        return $this->participants()->where('trips_participants.id_user', $id_user)->count() > 0
            || $this->reservations()->where('event_reservations.id_user', $id_user)->count() > 0;
    }
}
