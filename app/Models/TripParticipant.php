<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripParticipant extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table = 'trips_participants';

    public function trip()
    {
        return $this->belongsTo('\App\Models\Trip', 'id_trip', 'id_trip');
    }

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'id_user', 'id_user');
    }
}
