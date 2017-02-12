<?php

namespace App\Models;

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

    protected $fillable = [

    ];

    public function modifiedBy()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'modified_by');
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


    public static function findAllVisible()
    {
        return Event::with('modifiedBy.user')
            ->whereDate('visible_from', '<=', Carbon::today())
            ->whereDate('datetime_from', '>=', Carbon::today())
            ->get();
    }

    public static function findAll()
    {
        return Event::with('modified_by.user');
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
            $event->facebook_url = $data['facebook_url'];
            $event->modified_by = $id_user;
            $event->save();
            return $event;
        });
    }

    protected static function updateDatetimes($data)
    {
        $time = $data['visible_time'] ? $data['visible_time'] : "00:00 AM";
        $data['visible_from'] = Carbon::createFromFormat('d M Y g:i A', $data['visible_date'] . ' ' . $time);
        $time = $data['start_time'] ? $data['start_time'] : "00:00 AM";
        $data['datetime_from'] = Carbon::createFromFormat('d M Y g:i A', $data['start_date'] . ' ' . $time);
        return $data;
    }

}
