<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Buddy extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_user';
    public $incrementing = false;

    protected $fillable = [
        'id_faculty', 'about', 'phone'
    ];

    public function person()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'id_user');
    }

    public function exchangeStudents()
    {
        return $this->belongsTo('\App\Models\ExchangeStudent', 'id_user', 'id_buddy');
    }

    public function organizedTrips()
    {
        return $this->belongsToMany('\App\Models\Trip', 'trips_organizers', 'id_user', 'id_trip');
    }

    public function trips()
    {
        return $this->belongsToMany('\App\Models\Trip', 'trips_participants', 'id_user', 'id_trip')->withPivot('stand_in');
    }

    public function setVerified()
    {
        $this->verified = 'y';
        $this->save();
    }

    public function setDenied()
    {
        $this->verified = 'd';
        $this->save();
    }

    public function user()
    {
        return $this->person->user;
    }

    public function isVerified()
    {
        return $this->verified == 'y';
    }

    public function getDetailLink()
    {
        return url('partak/users/buddies/' . $this->id_user);
    }

    public function whoAmI($who)
    {
        return 'buddy' == $who;
    }

    public static function findBuddy($id_user)
    {
        return Buddy::with('person.user')->find($id_user);
    }

    public static function findAll()
    {
        return Buddy::with('person.user');
    }

    public static function registerBuddy($data)
    {
        return DB::transaction(function () use ($data) {
            $user = new User;
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->save();

            $person = new Person;
            $person->id_user = $user->id_user;
            $person->first_name = $data['first_name'];
            $person->last_name = $data['last_name'];
            $person->save();

            $buddy = new Buddy;
            $buddy->id_user = $user->id_user;
            $buddy->save();

            return $buddy;
        });
    }

    public function pickedStudentsToday()
    {
        return $this->exchangeStudents()->pickedToday()->count();
    }

    public static function scopeNotVerified($query)
    {
        return $query->where(function($query) {
            $query->whereHas('person.user', function($query) {
                $query->where('created_at', '>=', Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString())->where('verified',  '!=', 'y');
            })->orWhereHas('person.user', function($query) {
                $query->where(function($query) {
                    $query->whereNull('created_at')->orWhere('created_at', '<', Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString());
                })->where('active', 'n');
            });
        });
    }

    public static function scopeNotDenied($query)
    {
        return $query->where('verified', '!=', 'd');
    }

    public static function scopePartak($query)
    {
        return $query->whereHas('person.user.roles', function($query) {
            $query->where('title', 'partak');
        });

    }
}
