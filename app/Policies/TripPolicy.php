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
    {
        return $user->can('acl', 'trips.view') || $trip->isOrganizer($user->id_user);
    }

    public function edit(User $user, Trip $trip)
    {
        return $user->can('acl', 'trips.edit') || $trip->isOrganizer($user->id_user);
    }

    public function addParticipant(User $user, Trip $trip)
    {
        return $user->can('acl', 'participant.add') || $trip->isOrganizer($user->id_user);
    }

    public function removeParticipant(User $user, Trip $trip)
    {
        return $user->can('acl', 'participant.remove') || $trip->isOrganizer($user->id_user);
    }

    public function viewPayment(User $user, Trip $trip)
    {
        return $user->can('acl', 'trips.view_payment') || $trip->isOrganizer($user->id_user);
    }
}
