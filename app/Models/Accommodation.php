<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    const DEFAULT_ID = 21;

    protected $table = 'accommodation';
    public $timestamps = false;
    protected $primaryKey = 'id_accommodation';

    public function exchangeStudents()
    {
        return $this->hasMany('\App\Models\ExchangeStudent', 'id_accommodation', 'id_accommodation');
    }

    public function degreeStudents()
    {
        return $this->hasMany(DegreeStudent::class, 'id_accommodation');
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
        $Accommodations = [];
        foreach (Accommodation::all() as $accommodation) {
            $Accommodations[$accommodation->id_accommodation] = $accommodation->full_name_eng;
        }
        return $Accommodations;
    }

    public static function default(): self
    {
        return self::find(self::DEFAULT_ID);
    }
}
