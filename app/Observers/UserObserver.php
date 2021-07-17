<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function creating(User $user)
    {
        $hash = str_random(User::HASH_LENGTH);

        while (User::byHash($hash)->exists()) {
            $hash = str_random(User::HASH_LENGTH);
        }

        $user->hash = $hash;
    }
}
