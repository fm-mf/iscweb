<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public $timestamps = false;
    protected $primaryKey = 'id_user';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function person()
    {
        return $this->belongsTo('\App\Models\Person', 'id_user', 'id_user');
    }

    static function findByHash($hash)
    {
        return User::where('hash', $hash)->first();
    }

    public function roles()
    {
        return $this->belongsToMany('\App\Models\Role', 'users_roles', 'id_user', 'id_role');
    }

    public function isExchangeStudent()
    {
        return ExchangeStudent::where('id_user', $this->id_user)->exists();
    }

    public function isBuddy()
    {
        return Buddy::where('id_user', $this->id_user)->where('active', 'y')->exists();
    }

    public function isUnverifiedBuddy()
    {
        return Buddy::where('id_user', $this->id_user)->where('active', 'n')->exists();
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
            return $this->roles->contains('title', $role);
        } else if (id_array($role)) {
            foreach ($this->roles as $myRole) {
                if (in_array($myRole->title, $role)) {
                    return true;
                }
            }
            return false;
        }
        return !! $role->intersect($this->roles)->count();
    }
}
