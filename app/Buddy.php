<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buddy extends Model
{
    public function registerBuddy($data)
    {
        return DB::transaction(function () use ($data) {
            $user = new User;
            $user->email = $data['email'];
            $user->password = $data['password'];

            $person = new Person;
            $person->first_name = $data['first_name'];
            $person->last_name = $data['last_name'];

            $buddy = new Buddy;

            return $buddy;
        });
    }
}
