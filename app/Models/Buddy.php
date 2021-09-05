<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Propaganistas\LaravelPhone\PhoneNumber;

class Buddy extends Model
{
    const VERIFICATION_START_DATE = '2017-01-21 00:00:00';
    const DEFAULT_ACTIVITY_LIMIT_MONTHS = 4;

    public $timestamps = false;
    protected $primaryKey = 'id_user';
    public $incrementing = false;

    protected $fillable = [
        'id_faculty',
        'about',
        'phone',
        'subscribed',
        'agreement',
        'id_country',
        'motivation',
        'verification_email',
        'preferred_language',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function person()
    {
        return $this->belongsTo('\App\Models\Person', 'id_user', 'id_user');
    }

    public function exchangeStudents()
    {
        return $this->belongsTo('\App\Models\ExchangeStudent', 'id_user', 'id_buddy');
    }

    public function organizedTrips()
    {
        return $this->belongsToMany('\App\Models\Trip', 'trips_organizers', 'id_user', 'id_trip');
    }

    public function country()
    {
    	return $this->hasOne('\App\Models\Country', 'id_country', 'id_country');
    }

    public function trips()
    {
        return $this->belongsToMany('\App\Models\Trip', 'trips_participants', 'id_user', 'id_trip')
            ->withPivot('stand_in', 'paid', 'comment', 'registered_by', 'created_at')
            ->wherePivot('deleted_at', null);
    }

    public function setVerified()
    {
        $this->verified = 'y';
        $this->save();
    }

    public function setDenied()
    {
        $this->verified = 'd';
        $this->save();
    }

    public function isVerified(): bool
    {
        return $this->verified === 'y'
            || (
                (
                    $this->user->created_at === null
                    || $this->user->created_at->lessThan(Carbon::parse(self::VERIFICATION_START_DATE))
                )
                && (
                    $this->active === 'y'
                    || $this->subscribed === 1
                )
            );
    }

    public function isNotVerified(): bool
    {
        return !$this->isVerified();
    }

    public function isDenied()
    {
        return $this->verified === 'd';
    }

    public function isSubscribed()
    {
        return $this->subscribed === 1;
    }

    public function setWelcomeSent() {
        $this->welcome_mail_sent = 1;
        $this->save();
    }

    public function isWelcomeSent() {
        return $this->welcome_mail_sent == 1;
    }

    public function getDetailLink()
    {
        return url('partak/users/buddies/' . $this->id_user);
    }

    public function whoAmI($who)
    {
        return 'buddy' == $who;
    }

    public function getEmailAttribute($value)
    {
        return $this->person->email;
    }

    public function setEmailAttribute($value)
    {
        $this->person->email = $value;
    }

    public static function findBuddy($id_user)
    {
        return Buddy::with(['person.user', 'country'])->find($id_user);
    }

    public static function findAll()
    {
        return Buddy::with('person.user');
    }

    public static function registerBuddy(array $data): self
    {
        return DB::transaction(function () use ($data) {
            $user = User::create(Arr::only($data, [
                'email',
                'password',
            ]));

            $user->person()->create(Arr::only($data, [
                'first_name',
                'last_name',
            ]));

            return $user->buddy()->create(Arr::only($data, [
                'agreement',
            ]));
        });
    }

    public function pickedStudentsToday()
    {
        return $this->exchangeStudents()->pickedToday()->count();
    }

    public static function scopeNotVerified($query)
    {
        $applicableDate = Carbon::parse(self::VERIFICATION_START_DATE)->toDateTimeString();

        return $query->where(function($query) use ($applicableDate) {
            $query->whereHas('person.user', function($query) use ($applicableDate) {
                $query->where('created_at', '>=', $applicableDate)->where('verified', '!=', 'y');
            })->orWhereHas('person.user', function($query) use ($applicableDate) {
                $query->where(function($query) use ($applicableDate) {
                    $query->whereNull('created_at')->orWhere('created_at', '<', $applicableDate);
                })->where('active', 'n')->where('subscribed', 'y');
            });
        });
    }

    public static function scopeNotDenied($query)
    {
        return $query->where('verified', '!=', 'd');
    }

    public static function scopePartak($query)
    {
        return $query->whereHas('person.user.roles', function($query) {
            $query->where('title', 'partak');
        });

    }

    public function scopeFindByEmailAndPassword(Builder $query, string $email, string $password) {
        return $query->with('person.user')
            ->whereHas('person.user', function (Builder $query) use ($email, $password) {
                $query
                    ->where('password', User::encryptPassword($email, $password))
                    ->where('email', $email);
            })->first();
    }

    public function scopeRecentlyActive(Builder $query, Carbon $activeAfter = null): Builder
    {
        $activeAfter = $activeAfter ?? Carbon::now()->subMonths(self::DEFAULT_ACTIVITY_LIMIT_MONTHS);

        return $query->where('last_login', '>=', $activeAfter);
    }

    public function agreedPrivacyPartak()
    {
        return $this->privacy_partak;
    }

    public function setAgreedPrivacyPartak() {
        $this->privacy_partak = 1;
        $this->save();
    }

    /**
     * @return boolean
     */
    public function agreedPrivacyBuddy()
    {
        return $this->privacy_buddy;
    }

    public function setAgreedPrivacyBuddy()
    {
        $this->privacy_buddy = true;
        $this->save();
    }

    public function getRegisteredAgoAttribute()
    {
        if ($this->person->user->created_at == null) {
            return __('auth.long-time-ago');
        }

        return $this->person->user->created_at->diffForHumans();
    }

    public function getRegisteredOnAttribute()
    {
        $format = __('formatting.full-date') . ' ' . __('formatting.time-h-m');

        if ($this->person->user->created_at == null) {
            return __('auth.registered-before', [
                'date' => Carbon::parse(self::VERIFICATION_START_DATE)->formatLocalized($format)
            ]);
        }

        return $this->person->user->created_at->formatLocalized($format);
    }

    public function getPhoneFormattedAttribute()
    {
        if ($this->phone === null) {
            return null;
        }

        return PhoneNumber::make($this->phone, ['CZ', 'AUTO'])->formatInternational();
    }
}
