<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeStudent extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_user';

    public function person()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'id_user');
    }

    public function semesters()
    {
        return $this->belongsToMany('\App\Models\Semester', 'semesters_has_exchange_students', 'id_user', 'id_semester');
    }

    public static function findAll()
    {
        return ExchangeStudent::with('person.user');
    }

    public static function scopeBySemester($query, $semester)
    {
        return $query->whereHas('semesters', function($query) use ($semester) {
            $query->where('semester', $semester);
        });
    }

    public static function scopeByUniqueSemester($query, $semester)
    {
        return $query->whereHas('semesters', function($query) use ($semester) {
            $query->where('semester', $semester);
        })->whereDoesntHave('semesters', function($query) use ($semester) {
            $query->where('semester', '<>', $semester);
        });
    }

    public static function scopeWithoutBuddy($query)
    {
        return $query->where('id_buddy', NULL);
    }
}
