<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $table = 'accommodation';
    public $timestamps = false;
    protected $primaryKey = 'id_accommodation';

    public static function getOptions()
    {
        $Accommodations = [];
        foreach (Accommodation::all() as $accommodation) {
            $Accommodations[$accommodation->id_accommodation] = $accommodation->full_name_eng;
        }
        return $Accommodations;
    }
}
