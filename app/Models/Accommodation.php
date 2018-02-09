<?php

namespace App\Models;

use App\Traits\DynamicHiddenVisible;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use DynamicHiddenVisible;

    protected $table = 'accommodation';
    public $timestamps = false;
    protected $primaryKey = 'id_accommodation';

    public function exchangeStudents()
    {
        return $this->hasMany('\App\Models\ExchangeStudent', 'id_accommodation', 'id_accommodation');
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
        $Accommodations = [];
        foreach (Accommodation::all() as $accommodation) {
            $Accommodations[$accommodation->id_accommodation] = $accommodation->full_name_eng;
        }
        return $Accommodations;
    }
}
