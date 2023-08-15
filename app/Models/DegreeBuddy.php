<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreeBuddy extends Buddy
{
    protected $guarded = [];

    protected $table = 'buddies';

    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope('onlyDegreeBuddies', function (Builder $query) {
            $query->whereHas('user.roles', function (Builder $query) {
                $query->where('roles.id_role', Role::ID_FULL_TIME);
            })->orWhere('degree_buddy', true);
        });
    }
}
