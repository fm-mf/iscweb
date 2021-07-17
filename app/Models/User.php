<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use App\Traits\DynamicHiddenVisible;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, DynamicHiddenVisible;

    const HASH_LENGTH = 32;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public $timestamps = true;
    protected $primaryKey = 'id_user';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    private static $hashIdsSalt = 'eXQ3A9RejnCT7Ul/X3mQ3Writ+CpAVrQEc2hskzCU9E=';
    private static $hashIdsLength = 6;

    public function person()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'id_user');
    }

    public function buddy()
    {
        return $this->hasOne('\App\Models\Buddy', 'id_user', 'id_user');
    }

    public function exchangeStudent()
    {
        return $this->hasOne('\App\Models\ExchangeStudent', 'id_user', 'id_user');
    }

    public function roles()
    {
        return $this->belongsToMany('\App\Models\Role', 'users_roles', 'id_user', 'id_role');
    }

    public function reservations()
    {
        return $this->hasMany('\App\Models\EventReservation', 'id_user', 'id_user');
    }

    public function reservationByEvent(int $id_event)
    {
        return $this->reservations()
            ->where('id_event', $id_event)
            ->frist();
    }

    public function isExchangeStudent()
    {
        return ExchangeStudent::where('id_user', $this->id_user)->exists();
    }

    public function isBuddy()
    {
        return Buddy::with('person.user')->where('id_user', $this->id_user)
            ->where(function($query) {
                $query->where('verified', 'y')
                    ->orWhere(function ($query) {
                        $query->where('active', 'y')->whereHas('person.user', function($query) {
                            $query->whereNull('created_at')->orWhere('created_at', '<', Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString());
                        });
                    });

            })->exists();
    }

    public function isUnverifiedBuddy()
    {
        return Buddy::with('person.user')->where('id_user', $this->id_user)
            ->where(function($query) {
                $query->whereHas('person.user', function($query) {
                    $query->where('created_at', '>=', Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString())->where('verified',  '!=', 'y');
                })->orWhereHas('person.user', function($query) {
                    $query->where(function($query) {
                        $query->whereNull('created_at')->orWhere('created_at', '<', Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString());
                    })->where('active', 'n');
                });
            })->exists();
    }

    public function isPartak()
    {
        return $this->hasRole('partak');
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles()->get()->contains('title', $role);
        } else if (is_array($role)) {
            foreach ($this->roles()->get() as $myRole) {
                if (in_array($myRole->title, $role)) {
                    return true;
                }
            }
            return false;
        }
        return !! $role->intersect($this->roles)->count();
    }

    public function addRole($role)
    {
        if (is_integer($role)) {
            $this->roles()->attach($role);
        } else {
            $role = Role::where('title', $role)->first();
            if ($role) {
                $this->roles()->attach($role);
            }
        }

    }

    public function removeRole($role)
    {
        if (is_integer($role)) {
            $this->roles()->detach($role);
        } else {
            $role = Role::where('title', $role)->first();
            if ($role) {
                $this->roles()->detach($role);
            }
        }
    }

    public function addRoles($roles)
    {
        if (is_array($roles)) {
            $this->roles()->syncWithoutDetaching($roles);
        }
    }

    public function syncRoles($roles)
    {
        if (is_array($roles)) {
            $this->roles()->sync($roles);
        }
    }

    public function getEmailAttribute ($value)
    {
        return strtolower($value);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public static function encryptPassword($email, $password)
    {
        return hash("sha512", $email . '@' . $password);
    }

    public function getHashIdAttribute()
    {
        return (new Hashids(self::$hashIdsSalt, self::$hashIdsLength))->encode($this->id_user);
    }

    public static function decodeHashId(string $hashId)
    {
        $decoded = (new Hashids(self::$hashIdsSalt, self::$hashIdsLength))->decode($hashId);

        return $decoded[0] ?? null;
    }

    public function getPreferredLanguageAttribute()
    {
        return $this->buddy ? $this->buddy->preferred_language : null;
    }

    public static function findByHash($hash)
    {
        return User::byHash($hash)->first();
    }

    public function scopeByHash(Builder $query, string $hash): Builder
    {
        return $query->where('hash', '=', $hash);
    }
}
