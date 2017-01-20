<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ExchangeStudent extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_user';
    protected $dates = ['buddy_timestamp'];
    public $incrementing = false;

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

    public function buddy()
    {
        return $this->hasOne('\App\Models\Buddy', 'id_user', 'id_buddy');
    }

    public function isSelfPaying()
    {
        return $this->person->user->hasRole('samoplatce');
    }

    public function hasBuddy()
    {
        return $this->id_buddy != null;
    }

    public static function findAll()
    {
        return ExchangeStudent::with('person.user', 'country', 'faculty', 'accommodation', 'arrival');
    }

    public static function eagerFind($id_user)
    {
        return ExchangeStudent::with('person.user', 'country', 'faculty', 'accommodation', 'arrival')->find($id_user);
    }

    public static function scopeArrivalFilled($query)
    {
        $query->has('arrival');
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
            return $query->whereIn('id_country', self::filterToArray($values, 'id_country'));
        } else if ($filter == "accommodation") {
            return $query->whereIn('id_accommodation', self::filterToArray($values, 'id_accommodation'));
        } else if ($filter == "faculties") {
            return $query->whereIn('id_faculty', self::filterToArray($values, 'id_faculty'));
        } else if ($filter == "arrivals") {
            return $query->whereHas('arrival', function($query) use ($values) {
                $query->where(function($query) use ($values) {
                    foreach ($values as $value) {
                        $query->orWhereDate('arrival', '=', Carbon::createFromFormat('d M Y', $value));
                    }
                });
            });
        }
        return $query;
    }

    public static function scopeArriveToday($query)
    {
        return $query->whereHas('arrival', function ($query) {
            $query->whereDate('arrival', '=', Carbon::today()->toDateString());
        });
    }

    public static function scopePickedToday($query)
    {
        return $query->whereDate('buddy_timestamp', '=', Carbon::today()->toDateString());
    }

    public static function filterToArray($values, $key)
    {
        $filters = array();
        foreach ($values as $k => $v) {
            array_push($filters, $v[$key]);
        }
        return $filters;
    }
}
