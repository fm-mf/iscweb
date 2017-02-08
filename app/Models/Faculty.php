<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
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

}
