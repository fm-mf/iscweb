<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buddy extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'id_faculty', 'about', 'phone'
    ];

    public function person()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'id_user');
    }

    public function setVerified()
    {
        $this->active = 'y';
        $this->save();
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
            $buddy->id_user = $person->id_user;

            return $buddy;
        });
    }
}
