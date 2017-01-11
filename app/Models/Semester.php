<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_semester';

    public function exchangeStudents()
    {
        return $this->belongsToMany('\App\Models\ExchangeStudents', 'semesters_has_exchange_students', 'id_semester', 'id_user');
    }
}
