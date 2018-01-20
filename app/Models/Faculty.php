<?php

namespace App\Models;

use App\Traits\DynamicHiddenVisible;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use DynamicHiddenVisible;

    protected $primaryKey = 'id_faculty';
    public $timestamps = false;

    public function exchangeStudents()
    {
        return $this->hasMany('\App\Models\ExchangeStudent', 'id_faculty', 'id_faculty');
    }

    public function scopeWithStudents($query, $semester = null)
    {
        if (!$semester) {
            return $query->whereHas('exchangeStudents');
        }

        return $query->whereHas('exchangeStudents', function ($query) use ($semester) {
            $query->byUniqueSemester($semester)->wantBuddy()->withoutBuddy()->whereNotNull('about');
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

    public static function getFacultyFromAbbreviation($abbreviation): self
    {
        return self::where('abbreviation', $abbreviation)->first();
    }

}
