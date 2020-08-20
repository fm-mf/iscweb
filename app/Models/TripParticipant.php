<?php

namespace App\Models;

use App\Facades\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TripParticipant extends Model
{
    protected $timestamps = true;
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
