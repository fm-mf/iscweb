<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    protected $table = 'arrivals';
    public $timestamps = false;
    protected $primaryKey = 'id_user';

    protected $dates = ['arrival'];

    public function exchangeStudent()
    {
        return $this->hasOne('\App\Models\ExchangeStudent', 'id_user', 'id_user');
    }

    public function transportation()
    {
        return $this->hasOne('\App\Models\Transportation', 'id_transportation', 'id_transportation');
    }
}
