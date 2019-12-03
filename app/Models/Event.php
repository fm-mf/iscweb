<?php

namespace App\Models;

use App\Settings\Settings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Hashids\Hashids;

/**
 * @property number $id_event
 * @property Carbon $datetime_from
 * @property Carbon $visible_from
 * @property string $name
 * @property string $location
 * @property string $location_url
 * @property string $facebook_url
 * @property string $description
 * @property Carbon $created_at
 * @property \App\Models\Buddy $created_by
 * @property Carbon $updated_at
 * @property \App\Models\Buddy $modified_by
 * @property string $cover
 * @property string $event_type
 * @property boolean $ow
 * @property boolean $reservations_enabled
 * @property string $reservations_hash
 * @property number $reservations_removal_limit
 * @property boolean $reservations_diet
 * @property boolean $reservations_medical
 * @property \App\Models\Trip $trip
 * @property \App\Models\EventReservationQuestion[] $questions
*/
class Event extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id_event';
    //public $incrementing = false;

    protected $dates = ['datetime_from', 'updated_at', 'created_at', 'visible_from'];

    protected $fillable = [ 'name', 'datetime_from', 'visible_from', 'facebook_url', 'description', 'created_at',
        'visible_from', 'cover', 'created_by', 'modified_by', 'event_type', 'location', 'location_url',
        'reservations_enabled', 'reservations_medical', 'reservations_diet',
        'reservations_removal_limit', 'reservations_hash'];

    public function questions()
    {
        return $this->hasMany('\App\Models\EventReservationQuestion', 'id_event')->orderBy('order');
    }
    

    public function createdBy()
    {
        return $this->hasOne('\App\Models\Buddy', 'id_user', 'created_by');
    }

    public function modifiedBy()
    {
        return $this->hasOne('\App\Models\Buddy', 'id_user', 'modified_by');
    }

    public function Integreat_party()
    {
        return $this->hasOne('\App\Models\Integreat_party','id_event', 'id_event');
    }

    public function Languages_event()
    {
        return $this->hasOne('\App\Models\Languages_event','id_event', 'id_event');
    }

    public function Trip()
    {
        return $this->belongsTo('\App\Models\Trip', 'id_event', 'id_event');
    }

    /*
    public function trip()
    {
        return $this->belongsTo('\App\Models\Trip', 'id_event', 'id_event');
    }
    */
    public function hasTrip()
    {
        return Trip::where('id_event', $this->id_event)->exists();
    }

    public function scopeFindByHash(Builder $query, string $hash)
    {
        return $query
            ->where('reservations_hash', $hash)
            ->where('reservations_enabled', '1');
    }

    /**
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        // Set fb url to null if not present (why?)
        if (!array_key_exists('facebook_url', $attributes)) {
            $attributes['facebook_url'] = null;
        }

        // Generate new hash if not present
        if ((!isset($attributes['reservations_hash']) || !$attributes['reservations_hash']) && !$this->reservations_hash) {
            $attributes['reservations_hash'] = $this->getHashIds()->encode($this->id_event);
        }

        //dd($attributes);
        return parent::update(self::updateDatetimes($attributes), $options);
    }

    /**
     * @return bool
     */
    public function hasCover()
    {
        return $this->cover ? true : false;
    }

    /**
     * Returns path to event's cover
     * @return string
     */
    public function cover()
    {
        //todo: path to default cover
        return isset($this->cover) ? '/events/covers/' . $this->cover : '';
    }

    public function getCoverUrlAttribute()
    {
        if (empty($this->cover)) {
            return '';
        }

        return asset("events/covers/{$this->cover}");
    }

    public function calendarDateTimeFrom()
    {
        $time = $this->datetime_from->format('l') . '<br>'; //get name of the day in week eg. Mondey
        $time .= $this->datetime_from->format('F') . '<br>'; // get name of the month eg. March
        $time .= '<strong>' . $this->datetime_from->format('jS') . '</strong><br>'; //get day in month eg 30th
        $time .= $this->getTimeFormatted();

        return $time;
    }

    public function eventsDateTimeFrom()
    {
        $time = $this->datetime_from->format('l') . ' '; //get name of the day in week eg. Mondey
        $time .= $this->datetime_from->format('F') . ' '; // get name of the month eg. March
        $time .= $this->datetime_from->format('jS') . ' - '; //get day in month eg 30th
        $time .= $this->getTimeFormatted();

        return $time;
    }

    /**
     * @return string
     */
    public function getTimeFormatted()
    {
        $time = $this->datetime_from->format('g'); //get hour of the start
        if($this->datetime_from->minute == 0) {
            // if minutes are equal 0 then add only am or pm
            $time .= $this->datetime_from->format('a');
        } else {
            // if minutes are non zero then add minutes plus am or pm
            $time .= $this->datetime_from->format(':ia');
        }

        return $time;
    }

    /**
     * @return string
     */
    public function nameWithoutSpaces()
    {
        return str_replace(' ', '_', $this->name);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public static function findMaxYearOld()
    {
        return Event::whereDate('datetime_from', '<', Carbon::today())
                    ->whereDate('datetime_from', '>', Carbon::today()->subYear())
                    ->get();
    }

    public static function findAllVisible()
    {
        return Event::with('modifiedBy')
            ->whereDate('datetime_from', '>=', Carbon::today())
            ->where('visible_from','<=', Carbon::now())
            ->orderBy('datetime_from','asc')
            ->get();
    }

    public static function findAllNormalActive()
    {
        return Event::with('modifiedBy')
            ->where('event_type', 'normal')
            ->whereDoesntHave('trip')
            ->whereDate('datetime_from', '>=', Carbon::today())
            ->get()->sortby('datetime_from');
    }

    public static function findAllInteGreatInFromDate($fromDate)
    {
        return Event::with('modifiedBy')
            ->where('event_type', 'integreat')
            ->whereHas('integreat_party')
            ->whereDate('datetime_from', '>=', $fromDate)
            ->get()->sortby('datetime_from');
    }

    public static function findAllLanguagesFromDate($fromDate)
    {
        return Event::with('modifiedBy')
            ->where('event_type', 'languages')
            ->whereHas('Languages_event')
            ->whereDate('datetime_from', '>=', $fromDate)
            ->get()->sortby('datetime_from');
    }

    public static function findAll()
    {
        return Event::with('modified_by.user')->sortby('datetime_from');;
    }

    public static function createEvent($data)
    {
        $data = self::updateDatetimes($data);
        $id_user = Auth::id();
        $hashId = $this->getHashIds();

        return DB::transaction(function () use ($data, $id_user, $hashId) {
            $event = new Event();
            $event->visible_from = $data['visible_from'];
            $event->datetime_from = $data['datetime_from'];
            $event->name = $data['name'];
            
            $event->location = $data['location'] ?? '';
            $event->location_url = $data['location_url'] ?? '';
            $event->reservations_enabled = $data['reservations_enabled'] ?? 0;
            $event->reservations_medical = $data['reservations_medical'] ?? null;
            $event->reservations_diet = $data['reservations_diet'] ?? null;
            $event->reservations_removal_limit = $data['reservations_removal_limit'] ?? null;

            $event->description = $data['description'];
            $event->facebook_url = array_key_exists('facebook_url', $data) ? $data['facebook_url'] : NULL;
            $event->modified_by = $id_user;
            $event->created_by = $id_user;
            if(array_key_exists('event_type', $data)) $event->event_type = $data['event_type'];
            $event->save();

            $event->reservations_hash = $hashId->encode($event->id_event);
            $event->save();

            return $event;
        });
    }

    protected static function updateDatetimes($data)
    {
        $time = $data['visible_time'] ? $data['visible_time'] : "00:00 AM";
        $data['visible_from'] = Carbon::createFromFormat('d M Y g:i A', $data['visible_date'] . ' ' . $time)->toDateTimeString();
        $time = $data['start_time'] ? $data['start_time'] : "00:00 AM";
        $data['datetime_from'] = Carbon::createFromFormat('d M Y g:i A', $data['start_date'] . ' ' . $time)->toDateTimeString();
        return $data;
    }

    public static function getAllTypes()
    {
        $data = \DB::select('describe events event_type');
        preg_match('/^enum\((.*)\)$/', $data[0]->Type, $matches);
        $enum = [];
        foreach( explode(',', $matches[1]) as $value )
        {
            $value = trim( $value, "'" );
            $enum[$value] = $value;
        }
        return $enum;
    }

    /**
     * Returns collection of integreat events for which are held after $fromDate
     *
     * @param $fromDate
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public static function getAllIntegreatEvents($fromDate)
    {
        return Event::with('Integreat_party')->where('event_type', '=', 'integreat')
            ->whereDate('visible_from','>=', $fromDate)
            ->orderBy('datetime_from','asc')
            ->get();
    }

    private function getHashIds()
    {
        return new Hashids("events");
    }
}
