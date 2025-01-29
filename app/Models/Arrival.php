<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    const FORM_DATE_FORMAT = 'd M Y';
    const FORM_TIME_FORMAT = 'g:i A';

    protected $table = 'arrivals';
    public $timestamps = false;
    protected $primaryKey = 'id_user';

    protected $dates = ['arrival'];

    protected $appends = ['arrivalFormatted'];

    protected $fillable = [
        'arrival_date',
        'arrival_time',
        'transportation',
        'arrival_place',
    ];

    public function exchangeStudent()
    {
        return $this->belongsTo('\App\Models\ExchangeStudent', 'id_user', 'id_user');
    }

    public function degreeStudent()
    {
        return $this->belongsTo(DegreeStudent::class, 'id_user');
    }

    public function transportation()
    {
        return $this->hasOne('\App\Models\Transportation', 'id_transportation', 'id_transportation');
    }

    public function getArrivalFormattedAttribute()
    {
        return $this->arrival->format('d. m. Y H:i');
    }

    public function getArrivalDateFormatted()
    {
        return $this->arrival->format('d. m. Y');
    }

    public function scopeWithStudents($query, $semester = null)
    {
        $relationshipName = auth()->user()->isDegreeBuddy() ? 'degreeStudent' : 'exchangeStudent';

        if (!$semester) {
            return $query->whereHas($relationshipName);
        }

        return $query->whereHas($relationshipName, function ($query) use ($semester) {
            $query->availableToPick($semester);
        })->orderBy('arrival');
    }

    public function setTransportationAttribute(int $value)
    {
        $this->id_transportation = $value;
    }

    public function setArrivalDateAttribute(string $value)
    {
        if ($this->arrival == null) {
            $this->arrival = Carbon::parse($value);
            return;
        }

        $this->arrival = Carbon::parse($value)->setTimeFrom($this->arrival);
    }

    public function setArrivalTimeAttribute(string $value)
    {
        if ($this->arrival == null) {
            $this->arrival = Carbon::parse($value);
            return;
        }

        $this->arrival = Carbon::parse($value)->setDateFrom($this->arrival);
    }
}
