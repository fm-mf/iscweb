<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
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
        return $this->belongsToMany('\App\Models\Buddy', 'trips_organizers', 'id_trip', 'id_user');
    }

    public function participants()
    {
        return $this->belongsToMany('\App\Models\ExchangeStudent', 'trips_participants', 'id_trip', 'id_user');
    }

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_user', 'id_event');
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

    public static function findAllVisible()
    {
        return Event::with('modifiedBy.user')
            ->whereDate('visible_from', '<=', Carbon::today())
            ->whereDate('registration_to', '>', Carbon::today())
            ->get();
    }

    public static function findAll()
    {
        return Event::with('modifid_by.user');
    }



}
