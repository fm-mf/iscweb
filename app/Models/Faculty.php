<?php

namespace App\Models;

use App\Traits\DynamicHiddenVisible;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use DynamicHiddenVisible;

    protected $primaryKey = 'id_faculty';
    public $timestamps = false;

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
