<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function addParticipant($idPart, $allowStandIn = true)
    {
        $standIn = $this->isFull() ? 'y' : 'n';
        if ($standIn == 'y' && !$allowStandIn) {
            return self::TRIP_FULL;
        }
        
        $this->attach($idPart, ['stand_in' => $standIn]);

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
                $this->updateExistingPivot($standIn, ['stand_in' => 'n']);
            }
        }
        $this->participants()->detach($idPart);
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
