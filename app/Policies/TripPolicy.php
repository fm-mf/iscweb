<?php

namespace App\Policies;

use App\Models\Buddy;
use App\Models\User;
use App\Models\Trip;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the trip.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Trip  $trip
     * @return mixed
     */
    public function view(User $user, Trip $trip)
    {   $organize = $trip->organizers()->where('trips_organizers.id_user', $user->id_user)->exists();
        if($organize) return true;
        if($user->can('acl', 'trips.view')) return true;
        return false;
    }
}
