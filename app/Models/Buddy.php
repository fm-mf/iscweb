<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buddy extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_user';
    public $incrementing = false;

    protected $fillable = [
        'id_faculty', 'about', 'phone', 'subscribed', 'id_country'
    ];

    public function user()
    {
        return $this->person->user;
    }

    public function person()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'id_user');
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

    public function isVerified()
    {
        return $this->verified == 'y';
    }

    public function isSubscribed()
    {
        return $this->subscribed == 'y';
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

    public static function registerBuddy($data)
    {
        return DB::transaction(function () use ($data) {
            $user = new User;
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->save();

            $person = new Person;
            $person->id_user = $user->id_user;
            $person->first_name = $data['first_name'];
            $person->last_name = $data['last_name'];
            $person->save();

            $buddy = new Buddy;
            $buddy->id_user = $user->id_user;
            $buddy->agreement = $data['agreement'];
            $buddy->id_country = $data['id_country'];
            $buddy->save();

            return $buddy;
        });
    }

    public function pickedStudentsToday()
    {
        return $this->exchangeStudents()->pickedToday()->count();
    }

    public static function scopeNotVerified($query)
    {
        $applicableDate = Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString();
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

    public function setAgreedPrivacyBuddy() {
        $this->privacy_buddy = true;
        $this->save();
    }
}
