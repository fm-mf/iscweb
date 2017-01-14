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

    public function country()
    {
        return $this->hasOne('\App\Models\Country', 'id_country', 'id_country');
    }

    public function faculty()
    {
        return $this->hasOne('\App\Models\Faculty', 'id_faculty', 'id_faculty');
    }

    public function accommodation()
    {
        return $this->hasOne('\App\Models\Accommodation', 'id_accommodation', 'id_accommodation');
    }

    public function arrival()
    {
        return $this->belongsTo('\App\Models\Arrival', 'id_user', 'id_user');
    }

    public static function findAll()
    {
        return ExchangeStudent::with('person.user', 'country', 'faculty');
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

    public static function scopeFilter($query, $filter, $values)
    {
        if (!is_array($values)) {
            $values = [$values];
        }
        if ($filter == "countries") {
            return $query->whereIn('id_country', $values);
        } else if ($filter == "accommodation") {
            return $query->whereIn('id_accommodation', $values);
        } else if ($filter == "faculties") {
            return $query->whereIn('id_faculty', $values);
        } else if ($filter == "arrival") {
            //todo: implement
            return $query;
        }
        return $query;
    }
}
