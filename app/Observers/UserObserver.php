<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saved(User $user)
    {
        if ($user->hash_id == null) {
            $user->generateHashId();
        }
    }
}
