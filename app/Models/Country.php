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
            return Country::whereHas('exchangeStudent')->get();
        }

        return Country::whereHas('exchangeStudent', function($query) use ($semester) {
            return $query->whereHas('semesters', function($query) use ($semester) {
                $query->where('semester', $semester);
            });
        })->get();
    }
}
