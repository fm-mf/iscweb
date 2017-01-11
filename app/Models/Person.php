<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_user';

    public function user()
    {
        return $this->hasOne('\App\Models\User', 'id_user', 'id_user');
    }

}
