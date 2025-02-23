<?php

namespace App\Models;

use App\Facades\Settings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Semester extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_semester';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('defaultOrder', function (Builder $builder) {
            $builder->orderBy(DB::raw('`semesters`.`id_semester`'), 'desc');
        });

        static::addGlobalScope('noTest', function (Builder $query) {
            $query->where(DB::raw('`semesters`.`semester`'), 'NOT LIKE', '%test%');
        });
    }

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

    public function optionalPreviousSemester()
    {
        return self::where('id_semester', '<', $this->id_semester)->orderBy('id_semester', 'desc')->first();
    }


    public function previousSemester(): Semester
    {
        $nextSemester = self::where('id_semester', '<', $this->id_semester)->orderBy('id_semester', 'desc')->first();
        if (isset($nextSemester)) {
            return $nextSemester;
        } else {
            throw new \Exception('No previous semester to ' . $this->semester);
        }
    }

    public function hasPreviousSemester(): bool
    {
        return $this->optionalPreviousSemester() !== null;
    }

    public function scopeCurrentSemester(Builder $query): Builder
    {
        return $query->where('semester', Settings::currentSemester());
    }

    public static function getCurrentSemester(): Semester
    {
        return self::currentSemester()->first();
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

    public function getNameAttribute(): string
    {
        return ucfirst($this->getFullName());
    }

    public function getNameLocalizedAttribute($long = ''): string
    {
        $y1 = intval(substr($this->semester, -4, 4));
        $y2 = $y1 + 1;
        $key = "buddy-program.autumn-semester$long";

        if ($this->isSpringSemester()) {
            $y2 = $y1;
            $y1 -= 1;
            $key = "buddy-program.spring-semester$long";
        }

        return __($key, ['y1' => $y1, 'y2' => $y2]);
    }

    public function getNameLocalizedLongAttribute(): string
    {
        return $this->getNameLocalizedAttribute('-long');
    }

    public function isSpringSemester(): bool
    {
        return Str::startsWith($this->semester, 'spring');
    }

    public function isAutumnSemester(): bool
    {
        return Str::startsWith($this->semester, 'fall');
    }

    public static function findByName(string $name): self
    {
        return self::where(
            'semester',
            '=',
            strtolower(str_replace(' ', '', $name))
        )->first();
    }
}
