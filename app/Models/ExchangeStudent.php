<?php

namespace App\Models;

use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Propaganistas\LaravelPhone\PhoneNumber;

class ExchangeStudent extends Model
{
    use HasFactory;
    use FormAccessible;

    public $timestamps = false;
    protected $primaryKey = 'id_user';
    protected $dates = ['buddy_timestamp', 'quarantined_until'];
    public $incrementing = false;

    protected $casts = [
        'privacy_policy' => 'boolean',
        'degree_student' => 'boolean',
    ];

    protected $fillable = [
        'id_faculty', 'about', 'phone', 'esn_registered', 'esn_card_number', 'id_accommodation',
        'whatsapp', 'facebook', 'esn_receipt_id', 'id_country', 'school', 'instagram', 'note',
        'quarantined_until',
        'accommodation',
        'willing_to_present',
        'opt_out',
        'privacy_policy',
        'degree_student',
        'want_buddy',
    ];

    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope('onlyExchangeStudents', function (Builder $query) {
            $query->whereDoesntHave('user.roles', function (Builder $query) {
                $query->where('roles.id_role', Role::ID_FULL_TIME);
            })->where('degree_student', false);
        });
    }

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'id_user', 'id_user');
    }

    public function person()
    {
        return $this->belongsTo('\App\Models\Person', 'id_user', 'id_user');
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
        return $this->hasOne('\App\Models\Arrival', 'id_user', 'id_user');
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

    public function esnReceipt()
    {
        return $this->hasOne('\App\Models\Receipt', 'id_receipt', 'esn_receipt_id');
    }

    public function isSelfPaying()
    {
        return $this->degree_student;
    }

    public function markAsDegreeStudent(bool $degreeStudent = true)
    {
        $this->update([
            'degree_student' => $degreeStudent,
        ]);
    }

    public function unmarkAsDegreeStudent()
    {
        $this->markAsDegreeStudent(false);
    }

    public function hasBuddy()
    {
        return $this->id_buddy != null;
    }

    public function removeBuddy()
    {
        $this->id_buddy = null;
        $this->buddy_timestamp = null;
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
        return $query->whereHas('semesters', function ($query) use ($semester) {
            $query->where('semester', $semester);
        });
    }

    public static function scopeByUniqueSemester($query, $semester)
    {
        $previousSemester = Semester::where('semester', $semester)->first()->optionalPreviousSemester();

        $query = $query->whereHas('semesters', function ($query) use ($semester) {
            $query->where('semester', $semester);
        });

        if ($previousSemester) {
            $query->whereDoesntHave('semesters', function ($query) use ($previousSemester) {
                $query->where('semester', $previousSemester->semester);
            });
        }

        return $query;
    }

    public static function scopeWithoutBuddy($query)
    {
        return $query->where('id_buddy', null);
    }

    public static function scopeFilter($query, $filter, $values)
    {
        if (!is_array($values)) {
            // we want to treat all cases as arrays (even when a string or a number is passed)
            $values = [$values];
        }
        if ($filter == "countries") {
            return $query->whereIn('id_country', self::filterToArray($values, 'id_country'));
        } elseif ($filter == "accommodation") {
            return $query->whereIn('id_accommodation', self::filterToArray($values, 'id_accommodation'));
        } elseif ($filter == "faculties") {
            return $query->whereIn('id_faculty', self::filterToArray($values, 'id_faculty'));
        } elseif ($filter == "arrivals") {
            return $query->whereHas('arrival', function ($query) use ($values) {
                $query->where(function ($query) use ($values) {
                    foreach ($values as $value) {
                        $dayBeginning = Carbon::createFromFormat('j. n. Y', $value)->setTime(0, 0, 0);
                        $dayEnd = $dayBeginning->copy()->setTime(23, 59, 59);
                        $query->orWhere(function ($query) use ($dayBeginning, $dayEnd) {
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

    public function scopeWithAll($query)
    {
        $query->with(['person.user', 'country', 'faculty', 'accommodation', 'arrival']);
    }

    public function scopeJoinAll($query)
    {
        return $query->leftJoin('arrivals', 'arrivals.id_user', '=', 'exchange_students.id_user')
            ->join('people', 'people.id_user', '=', 'exchange_students.id_user')
            ->join('countries', 'countries.id_country', '=', 'exchange_students.id_country')
            ->join('faculties', 'faculties.id_faculty', '=', 'exchange_students.id_faculty')
            ->join('accommodation', 'accommodation.id_accommodation', '=', 'exchange_students.id_accommodation');
    }

    public function scopeWithFilledProfile(Builder $query, string $semester): Builder
    {
        return $query
            ->byUniqueSemester($semester)
            ->where(function (Builder $query) {
                $query
                    ->wantBuddy()
                    ->orWhereHas('buddy');
            })
            ->where(function ($query) {
                $query
                    ->whereNotNull('about')
                    ->orWhereNotNull('facebook')
                    ->orWhereNotNull('whatsapp')
                    ->orWhereNotNull('instagram')
                    ->orWhere(DB::raw('exchange_students.id_accommodation'), '<>', Accommodation::DEFAULT_ID)
                    ->orWhereHas('arrival')
                    ->orWhereHas('person', function ($query) {
                        $query->whereNotNull('avatar');
                    });
            });
    }

    public function scopeWithoutFilledProfile(Builder $query, $semester): Builder
    {
        return $query
            ->byUniqueSemester($semester)
            ->wantBuddy()
            ->whereDoesntHave('buddy')
            ->whereNull('about')
            ->whereNull('facebook')
            ->whereNull('whatsapp')
            ->whereNull('instagram')
            ->whereDoesntHave('arrival')
            ->where(DB::raw('exchange_students.id_accommodation'), Accommodation::DEFAULT_ID)
            ->whereHas('person', function ($query) {
                $query->whereNull('avatar');
            });
    }

    public function scopeWithFilledArrival($query, $semester)
    {
        $query->byUniqueSemester($semester)
            ->wantBuddy()
            ->where(function ($query) {
                $query->whereHas('arrival');
            });
    }


    public function scopeAvailableToPick($query, $semester)
    {
        $query->withFilledProfile($semester)
            ->withoutBuddy();
    }

    public function scopeEsnRegistered(Builder $query): Builder
    {
        return $query
            ->whereNotNull('esn_card_number')
            ->where('esn_registered', 'y');
    }

    public function scopeToPreregister($query, $lastName, $firstName, $id)
    {
        $query
            ->whereNull('esn_card_number')
            ->whereNull('phone')
            ->join('people', 'people.id_user', 'exchange_students.id_user')
            ->whereHas('person', function ($query) use ($lastName, $firstName, $id) {
                $query
                    ->where('last_name', '>', $lastName)
                    ->orWhere(function ($query) use ($lastName, $firstName, $id) {
                        $query->where('last_name', $lastName)
                            ->where(function ($query) use ($firstName, $id) {
                                $query->where('first_name', '>', $firstName)
                                    ->orWhere(function ($query) use ($firstName, $id) {
                                        $query->where('first_name', $firstName)
                                            ->where('id_user', '>', $id);
                                    });
                            });
                    });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->orderBy('exchange_students.id_user');
    }

    public function isAvailableToPick()
    {
        return $this->hasSemester(Semester::getCurrentSemester())
            && !$this->hasSemester(Semester::getCurrentSemester()->previousSemester())
            && ($this->about != null
                || $this->arrival != null
                || $this->person->avatar != null
                || $this->facebook != null
                || $this->whatsapp != null
                || $this->instagram != null
                || $this->id_accommodation != Accommodation::DEFAULT_ID
            )
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

    public function scopeQuarantined(Builder $query): Builder
    {
        return $query->with(['user', 'person.exchangeStudent', 'person.buddy'])
            ->where('quarantined_until', '>', now())
            ->orderBy('quarantined_until');
    }

    public static function findQuarantined(): Collection
    {
        return self::quarantined()->get();
    }

    public function scopeFindByEsn(Builder $query, string $esn)
    {
        return $query->with('person.user')->where('esn_card_number', $esn);
    }


    public function scopeFindByEmailAndEsn(Builder $query, string $email, string $esnCardNumber)
    {
        return $query->with('person.user')
            ->where('esn_card_number', $esnCardNumber)
            ->whereHas('person.user', function (Builder $query) use ($email) {
                $query->where('email', $email);
            });
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

    public function scopeIncludingDegreeStudents(Builder $query): Builder
    {
        return $query->withoutGlobalScope('onlyExchangeStudents');
    }

    public function getHashIdAttribute()
    {
        return $this->person->hashId;
    }

    public function getPhoneFormattedAttribute()
    {
        if ($this->phone === null) {
            return null;
        }

        return PhoneNumber::make($this->phone, ['CZ', 'AUTO'])->formatInternational();
    }

    public function getWhatsAppFormattedInternationalAttribute()
    {
        if ($this->whatsapp === null) {
            return null;
        }

        return PhoneNumber::make($this->whatsapp)->formatInternational();
    }

    public function getWhatsAppFormattedE164Attribute()
    {
        if ($this->whatsapp === null) {
            return null;
        }

        return PhoneNumber::make($this->whatsapp)->formatE164();
    }

    public function getAgeRangeAttribute()
    {
        $age = intval(date('Y')) - ($this->person->age);

        return ($age - 1) . '–' . $age;
    }

    public function getIsEsnRegisteredAttribute()
    {
        return $this->esn_registered === 'y';
    }

    public function getIsNotEsnRegisteredAttribute()
    {
        return $this->esn_registered === 'n';
    }

    public function getQuarantinedAttribute()
    {
        return $this->quarantined_until !== null
            ? $this->quarantined_until->isAfter(Carbon::now())
            : false;
    }

    public function getInstagramLinkAttribute()
    {
        return "https://instagram.com/{$this->instagram}";
    }

    public function getFacebookTrimmedAttribute()
    {
        return preg_replace('/^https?:\/\/(www\.)?facebook\.com/i', '...', $this->facebook);
    }

    public function getWillingToPresentAttribute(): bool
    {
        return $this->wants_present === 'y';
    }

    public function setWillingToPresentAttribute(bool $value)
    {
        $this->wants_present = $value ? 'y' : 'n';
    }

    public function getOptOutAttribute(): bool
    {
        return $this->want_buddy !== 'y';
    }

    public function setOptOutAttribute(bool $value)
    {
        $this->want_buddy = !$value ? 'y' : 'n';
    }

    public function setAccommodationAttribute(int $value)
    {
        $this->id_accommodation = $value;
    }

    public function formArrivalDateAttribute(): ?string
    {
        return $this->arrival == null
            ? null
            : $this->arrival->arrival->format(Arrival::FORM_DATE_FORMAT);
    }

    public function formArrivalTimeAttribute(): ?string
    {
        return $this->arrival == null
            ? null
            : $this->arrival->arrival->format(Arrival::FORM_TIME_FORMAT);
    }

    public function formTransportationAttribute(): ?int
    {
        return $this->arrival == null
            ? null
            : $this->arrival->id_transportation;
    }

    public function formAccommodationAttribute(): ?int
    {
        return $this->id_accommodation;
    }

    public function getAboutHtmlAttribute(): HtmlString
    {
        $aboutText = htmlspecialchars($this->about);
        $aboutText = "<p>$aboutText</p>";
        $aboutText = preg_replace("/\r\n(\r\n)+/", '</p><p>', $aboutText);
        $aboutText = preg_replace("/\r\n/", '<br />', $aboutText);

        return new HtmlString($aboutText);
    }
}
