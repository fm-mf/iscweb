<?php

namespace App\Models;

use App\Traits\DynamicHiddenVisible;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExchangeStudent extends Model
{
    use DynamicHiddenVisible;

    public $timestamps = false;
    protected $primaryKey = 'id_user';
    protected $dates = ['buddy_timestamp'];
    public $incrementing = false;

    protected $casts = [
        'privacy_policy' => 'boolean',
    ];

    protected $fillable = [
        'id_faculty', 'about', 'phone', 'esn_registered', 'esn_card_number', 'id_accommodation',
        'whatsapp', 'facebook'
    ];

    public function person()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'id_user');
    }

    public function semesters()
    {
        return $this->belongsToMany('\App\Models\Semester', 'semesters_has_exchange_students', 'id_user', 'id_semester');
    }

    public function country()
    {
        return $this->hasOne('\App\Models\Country', 'id_country', 'id_country');
    }

    public function faculty()
    {
        return $this->hasOne('\App\Models\Faculty', 'id_faculty', 'id_faculty');
    }

    public function accommodation()
    {
        return $this->hasOne('\App\Models\Accommodation', 'id_accommodation', 'id_accommodation');
    }

    public function arrival()
    {
        return $this->belongsTo('\App\Models\Arrival', 'id_user', 'id_user');
    }

    public function buddy()
    {
        return $this->hasOne('\App\Models\Buddy', 'id_user', 'id_buddy');
    }

    public function trips()
    {
        return $this->belongsToMany('\App\Models\Trip', 'trips_participants', 'id_user', 'id_trip')
            ->withPivot('stand_in', 'paid', 'comment', 'registered_by', 'created_at')
            ->wherePivot('deleted_at', null);
    }

    public function isSelfPaying()
    {
        return $this->person->user->hasRole('samoplatce');
    }

    public function hasBuddy()
    {
        return $this->id_buddy != null;
    }

    public function removeBuddy()
    {
        $this->id_buddy = NULL;
        $this->buddy_timestamp = NULL;
        $this->save();
    }

    public function hasSemester(Semester $semester)
    {
        return $this->semesters->contains($semester);
    }

    public function wantBuddy()
    {
        return $this->want_buddy == 'y';
    }

    public function whoAmI($who)
    {
        return 'exchangeStudent' == $who;
    }

    public function getDetailLink()
    {
        return url('partak/users/exchange-students/' . $this->id_user);
    }
/*
    public function getEmailAttribute($value)
    {
        return $this->person->email;
    }

    public function setEmailAttribute($value)
    {
        $this->person->email = $value;
    }
*/
    public static function findAll()
    {
        return ExchangeStudent::with('person', 'person.user', 'country', 'faculty', 'accommodation', 'arrival');
    }

    public static function eagerFind($id_user)
    {
        return ExchangeStudent::with('person.user', 'country', 'faculty', 'accommodation', 'arrival')->find($id_user);
    }

    public static function scopeArrivalFilled($query)
    {
        $query->has('arrival');
    }

    public static function scopeBySemester($query, $semester)
    {
        return $query->whereHas('semesters', function($query) use ($semester) {
            $query->where('semester', $semester);
        });
    }

    public static function scopeByUniqueSemester($query, $semester)
    {
        $previusSmemester = Semester::where('semester', $semester)->first()->previousSemester();
        return $query->whereHas('semesters', function($query) use ($semester) {
            $query->where('semester', $semester);
        })->whereDoesntHave('semesters', function($query) use ($previusSmemester) {
            $query->where('semester', $previusSmemester->semester);
        });
    }

    public static function scopeWithoutBuddy($query)
    {
        return $query->where('id_buddy', NULL);
    }

    public static function scopeFilter($query, $filter, $values)
    {
        if (!is_array($values)) {
            // we want to treat all cases as arrays (even when a string or a number is passed)
            $values = [$values];
        }
        if ($filter == "countries") {
            return $query->whereIn('id_country', self::filterToArray($values, 'id_country'));
        } else if ($filter == "accommodation") {
            return $query->whereIn('id_accommodation', self::filterToArray($values, 'id_accommodation'));
        } else if ($filter == "faculties") {
            return $query->whereIn('id_faculty', self::filterToArray($values, 'id_faculty'));
        } else if ($filter == "arrivals") {
            return $query->whereHas('arrival', function($query) use ($values) {
                $query->where(function($query) use ($values) {
                    foreach ($values as $value) {
                        $dayBeginning = Carbon::createFromFormat('j. n. Y', $value)->setTime(0, 0, 0);
                        $dayEnd = $dayBeginning->copy()->setTime(23, 59, 59);
                        $query->orWhere(function($query) use ($dayBeginning, $dayEnd) {
                            $query->where('arrival', '>=', $dayBeginning->toDateTimeString())
                                ->where('arrival', '<=', $dayEnd->toDateTimeString());
                            });
                    }
                });
            });
        }
        return $query;
    }

    public static function scopeArriveToday($query)
    {
        return $query->whereHas('arrival', function ($query) {
            $query->whereDate('arrival', '=', Carbon::today()->toDateString());
        });
    }

    public static function scopePickedToday($query)
    {
        return $query->whereDate('buddy_timestamp', '=', Carbon::today()->toDateString());
    }

    public static function scopeWantBuddy($query)
    {
        return $query->where('want_buddy', 'y');
    }

    public function scopeWithAll($query) {
        $query->with(['person.user', 'country', 'faculty', 'accommodation', 'arrival']);
    }

    public function scopeJoinAll($query) {
        return $query->leftJoin('arrivals', 'arrivals.id_user', '=', 'exchange_students.id_user')
            ->join('people', 'people.id_user', '=', 'exchange_students.id_user')
            ->join('countries', 'countries.id_country', '=', 'exchange_students.id_country')
            ->join('faculties', 'faculties.id_faculty', '=', 'exchange_students.id_faculty')
            ->join('accommodation', 'accommodation.id_accommodation', '=', 'exchange_students.id_accommodation');
    }

    public function scopeWithFilledProfile($query, $semester) {
        $query->byUniqueSemester($semester)
                ->wantBuddy()
                ->where(function ($query) {
                    $query->whereNotNull('about')
                            ->orWhereHas('arrival')
                            ->orWhereHas('person', function ($query) {
                                $query->whereNotNull('avatar');
                            });
                });
    }

    public function scopeAvailableToPick($query, $semester) {
        $query->withFilledProfile($semester)
                ->withoutBuddy();
    }

    public function isAvailableToPick() {
        return $this->hasSemester(Semester::getCurrentSemester())
                && !$this->hasSemester(Semester::getCurrentSemester()->previousSemester())
                && ($this->about != null || $this->arrival != null || $this->person->avatar != null)
                && $this->wantBuddy()
                && !$this->hasBuddy();
    }

    public static function filterToArray($values, $key)
    {
        $filters = array();
        foreach ($values as $k => $v) {
            array_push($filters, $v[$key]);
        }
        return $filters;
    }

    public static function registerExStudent($data)
    {
        return DB::transaction(function () use ($data) {
            $user = new User;
            $user->email = $data['email'];
            $user->save();

            $person = new Person;
            $person->id_user = $user->id_user;
            $person->first_name = $data['first_name'];
            $person->last_name = $data['last_name'];
            $person->sex = $data['sex'];
            $person->save();

            $exStudent = new ExchangeStudent();
            $exStudent->id_user = $user->id_user;
            $exStudent->id_country = $data['id_country'];
            $exStudent->id_accommodation = $data['id_accommodation'];
            $exStudent->id_faculty = $data['id_faculty'];
            $exStudent->save();
            return $exStudent;
        });
    }

    public function scopeFindByEmail(Builder $query, string $email)
    {
        return $query->with('person.user')->whereHas('person.user', function (Builder $query) use ($email) {
            $query->where('email', $email);
        })->first();
    }

    public function scopeByEmails(Builder $query, array $emails)
    {
        return $query->with('person.user')->whereHas('person.user', function (Builder $query) use ($emails) {
            $query->whereIn('email', $emails);
        });
    }

    public function scopeGetByEmails(Builder $query, array $emails)
    {
        return $query->byEmails($emails)->get();
    }
}
