<?php

namespace App\Models;

use App\Traits\DynamicHiddenVisible;
use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    use DynamicHiddenVisible;

    protected $table = 'arrivals';
    public $timestamps = false;
    protected $primaryKey = 'id_user';

    protected $dates = ['arrival'];

    protected $appends = ['arrivalFormatted'];

    public function exchangeStudent()
    {
        return $this->belongsTo('\App\Models\ExchangeStudent', 'id_user', 'id_user');
    }

    public function transportation()
    {
        return $this->hasOne('\App\Models\Transportation', 'id_transportation', 'id_transportation');
    }

    public function getArrivalFormattedAttribute() {
        return $this->arrival->format('d. m. Y H:i');
    }

    public function scopeWithStudents($query, $semester = null)
    {
        if (!$semester) {
            return $query->whereHas('exchangeStudent');
        }

        return $query->whereHas('exchangeStudent', function ($query) use ($semester) {
            $query->availableToPick($semester);
        })->orderBy('arrival');
    }
}
