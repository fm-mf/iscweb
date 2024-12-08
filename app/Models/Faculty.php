<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $primaryKey = 'id_faculty';
    public $timestamps = false;

    public function buddies()
    {
        return $this->hasMany(Buddy::class, 'id_faculty');
    }

    public function exchangeStudents()
    {
        return $this->hasMany('\App\Models\ExchangeStudent', 'id_faculty', 'id_faculty');
    }

    public function degreeStudents()
    {
        return $this->hasMany(DegreeStudent::class, 'id_faculty');
    }

    public function scopeWithStudents($query, $semester = null)
    {
        $relationshipName = auth()->user()->isDegreeBuddy() ? 'degreeStudents' : 'exchangeStudents';

        if (!$semester) {
            return $query->whereHas($relationshipName);
        }

        return $query->whereHas($relationshipName, function ($query) use ($semester) {
            $query->availableToPick($semester);
        });
    }

    public static function getOptions()
    {
        $faculties = [];
        foreach (Faculty::all() as $faculty) {
            $faculties[$faculty->id_faculty] = $faculty->faculty;
        }
        return $faculties;
    }

    public static function getFacultyFromAbbreviation($abbreviation)
    {
        return self::where('abbreviation', $abbreviation)->first();
    }

}
