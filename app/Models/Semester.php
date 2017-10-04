<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_semester';

    public function exchangeStudents()
    {
        return $this->belongsToMany('\App\Models\ExchangeStudent', 'semesters_has_exchange_students', 'id_semester', 'id_user');
    }

    private static function addLastSemester(): Semester
    {
        $lastSemester = self::orderBy('id_semester', 'desc')->first();
        $newSemester = new self();
        if (strpos($lastSemester->semester, 'fall') !== false) {
            $year = ((int)substr($lastSemester->semester, 4, 4)) + 1;
            $newSemester->semester = 'spring' . $year;
        } else {
            $year = substr($lastSemester->semester, 6, 4);
            $newSemester->semester = 'fall' . $year;
        }
        $newSemester->save();
        return $newSemester;
    }

    public function nextSemester(): Semester
    {
        $nextSemester = self::where('id_semester', '>', $this->id_semester)->orderBy('id_semester')->first();
        if (isset($nextSemester)) {
            return $nextSemester;
        } else {
            return self::addLastSemester();
        }
    }

    public function previousSemester(): Semester
    {
        $nextSemester = self::where('id_semester', '<', $this->id_semester)->orderBy('id_semester', 'desc')->first();
        if (isset($nextSemester)) {
            return $nextSemester;
        } else {
            throw new \Exception('No previous semester');
        }
    }

    public static function getCurrentSemester(): Semester
    {
        $semesterName = \Settings::get('currentSemester');
        return Semester::where('semester', $semesterName)->first();
    }

    public function __toString()
    {
        return $this->semester;
    }

    public function getFullName(): string
    {
        $pos = strlen($this->semester) - 4;
        return substr_replace($this->semester, ' ', $pos, 0);
    }


}
