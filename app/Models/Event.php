<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id_event';
    public $incrementing = false;

    protected $dates = ['datetime_from', 'datetime_to', 'registration_to', 'updated_at', 'created_at'];

    protected $fillable = [

    ];

    public function modifiedBy()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'modified_id_user');
    }

    public function organizers()
    {
        return $this->belongsToMany('\App\Models\Buddy', 'events_organizers', 'id_event', 'id_user');
    }

    public function participants()
    {
        return $this->belongsToMany('\App\Models\ExchangeStudent', 'events_participants', 'id_event', 'id_user');
    }

    public function howIsFill()
    {
        //dd($this->participants()->count());
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

    public static function findAllVisible()
    {
        return Event::with('modifiedBy.user')
            ->whereDate('visible_from', '<=', Carbon::today())
            ->whereDate('registration_to', '>', Carbon::today())
            ->get();
    }

    public static function findAll()
    {
        return Event::with('modiedBy.user');
    }



}
