<?php

namespace App\Models;

use App\Models\User;
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

    public function setVerified()
    {
        $this->active = 'y';
        $this->save();
    }

    public static function findBuddy($id_user)
    {
        return Buddy::with('person.user')->find($id_user);
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
}
