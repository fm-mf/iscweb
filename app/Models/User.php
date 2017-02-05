<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

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
        return Buddy::with('person.user')->where('id_user', $this->id_user)
            ->where(function($query) {
                $query->where('verified', 'y')
                    ->orWhere(function ($query) {
                        $query->where('active', 'y')->whereHas('person.user', function($query) {
                            $query->where('created_at', '<', Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString());
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
                    $query->where('created_at', '<', Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString())->where('active', 'n');
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

    /**
     * Make sure that when we are inserting a new user to the database, the unique random identifier is generated
     */
    public function save(array $options = [])
    {
        if (!$this->exists && (!isset($this->hash) || $this->hash == null)) {
            $this->hash = $this->generateHash();
        }
        parent::save($options);
    }

    protected function generateHash()
    {
        $hash =  Str::random(32);
        if (User::findByHash($hash)) {
            return $this->generateHash();
        } else {
            return $hash;
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
}
