<?php

namespace App\Observers;

use App\Models\DegreeBuddy;

class DegreeBuddyObserver
{
    public function creating(DegreeBuddy $buddy)
    {
        $buddy->degree_buddy = true;
    }
}
