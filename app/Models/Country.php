<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    public $timestamps = false;
    protected $primaryKey = 'id_country';

    public function exchangeStudent()
    {
        return $this->belongsTo('\App\Models\ExchangeStudent', 'id_country', 'id_country');
    }

    public function exchangeStudents()
    {
        return $this->hasMany('\App\Models\ExchangeStudent', 'id_country', 'id_country');
    }

    public function buddy()
    {
        return $this->belongsTo('\App\Models\Buddy', 'id_country', 'id_country');
    }

    public function tandemUsers()
    {
        return $this->hasMany('App\\Models\\TandemUser', 'id_country', 'id_country');
    }

    public function scopeWithStudents($query, $semester = null)
    {
        if (!$semester) {
            return $query->whereHas('exchangeStudents');
        }

        return $query->whereHas('exchangeStudents', function ($query) use ($semester) {
            $query->availableToPick($semester);
        });
    }

    public static function getOptions()
    {
        $countries = [];
        foreach (Country::all() as $country) {
            $countries[$country->id_country] = $country->full_name;
        }
        return $countries;
    }

    public static function allWithStudents($semester = null)
    {
        if (!$semester) {
            return Country::whereHas('exchangeStudents')->get();
        }

        return Country::whereHas('exchangeStudents', function($query) use ($semester) {
            return $query->whereHas('semesters', function($query) use ($semester) {
                $query->where('semester', $semester);
            });
        })->get();
    }

    public static function getCountryIdFromTwoLetter(string $code): int
    {
        if (strlen($code) !== 2)
        {
            throw new \Exception('Code length is not two letters');
        }
        if ($code === 'UK') {
            $code = 'GB';
        }
        return self::where('two_letters', $code)->first(['id_country'])->id_country;
    }

    public static function getCountryIdFromThreeLetter(string $code): int
    {
        if (strlen($code) !== 3)
        {
            throw new \Exception('Code length is not three letters');
        }
            return self::where('three_letters', $code)->first(['id_country'])->id_country;
    }
}
