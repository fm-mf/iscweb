<?php

namespace App\Models;

use App\Settings\Settings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id_event';
    //public $incrementing = false;

    protected $dates = ['datetime_from', 'updated_at', 'created_at', 'visible_from'];

    protected $fillable = [ 'name', 'datetime_from', 'visible_from', 'facebook_url', 'description', 'created_at', 'visible_from', 'cover', 'created_by', 'modified_by', 'event_type'];

    public function createdBy()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'created_by');
    }

    public function modifiedBy()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'modified_by');
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


    public function update(array $attributes = [], array $options = [])
    {

        if(! array_key_exists('facebook_url', $attributes)) $attributes['facebook_url'] = NULL;
        //dd($attributes);
        return parent::update(self::updateDatetimes($attributes), $options);
    }

    public function hasCover()
    {
        return $this->cover ? true : false;
    }

    public function cover()
    {
        //TODO: vratit spravny cover
        return isset($this->cover) ? '/events/covers/' . $this->cover : '';
    }

    public function calendarDateTimeFrom()
    {
        $time = $this->datetime_from->format('l') . '<br>'; //get name of the day in week eg. Mondey
        $time .= $this->datetime_from->format('F') . '<br>'; // get name of the month eg. March
        $time .= '<strong>' . $this->datetime_from->format('jS') . '</strong><br>'; //get day in month eg 30th
        $time .= $this->getTimeFormatted();

        return $time;
    }

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

    public function nameWithoutSpaces()
    {
        return str_replace(' ', '_', $this->name);
    }

    public static function findMaxYearOld()
    {
        return Event::whereDate('datetime_from', '<', Carbon::today())
                    ->whereDate('datetime_from', '>', Carbon::today()->subYear())
                    ->get();
    }

    public static function findAllVisible()
    {
        return Event::with('modifiedBy.user')
            ->whereDate('datetime_from', '>=', Carbon::today())
            ->whereDate('visible_from','<=', Carbon::today())
            ->orderBy('datetime_from','asc')
            ->get();
    }

    public static function findAllNormalActive()
    {
        return Event::with('modifiedBy.user')
            ->where('event_type', 'normal')
            ->whereDoesntHave('trip')
            ->whereDate('datetime_from', '>=', Carbon::today())
            ->get()->sortby('datetime_from');;
    }

    public static function findAllInteGreatInFromDate($fromDate)
    {
        return Event::with('modifiedBy.user')
            ->where('event_type', 'integreat')
            ->whereHas('integreat_party')
            ->whereDate('datetime_from', '>=', $fromDate)
            ->get()->sortby('datetime_from');;
    }

    public static function findAllLanguagesFromDate($fromDate)
    {
        return Event::with('modifiedBy.user')
            ->where('event_type', 'languages')
            ->whereHas('Languages_event')
            ->whereDate('datetime_from', '>=', $fromDate)
            ->get()->sortby('datetime_from');;
    }

    public static function findAll()
    {
        return Event::with('modified_by.user')->sortby('datetime_from');;
    }

    public static function createEvent($data)
    {
        $data = self::updateDatetimes($data);
        $id_user = Auth::id();
        return DB::transaction(function () use ($data, $id_user) {
            $event = new Event();
            $event->visible_from = $data['visible_from'];
            $event->datetime_from = $data['datetime_from'];
            $event->name = $data['name'];

            $event->description = $data['description'];
            $event->facebook_url = array_key_exists('facebook_url', $data) ? $data['facebook_url'] : NULL;
            $event->modified_by = $id_user;
            $event->created_by = $id_user;
            if(array_key_exists('event_type', $data)) $event->event_type = $data['event_type'];
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


}
