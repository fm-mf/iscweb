<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user)
    {
        $hash = Str::random(User::HASH_LENGTH);

        while (User::byHash($hash)->exists()) {
            $hash = Str::random(User::HASH_LENGTH);
        }

        $user->hash = $hash;
    }
}
