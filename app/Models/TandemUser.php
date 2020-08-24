<?php

namespace App\Models;

use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class TandemUser extends Authenticatable
{
    const ACTIVE_THRESHOLD_MONTHS = 9;

    protected $primaryKey = 'id_tandemuser';

    protected $guarded = [];

    public $timestamps = false;

    protected $rememberTokenName = false;

    protected $dates = [
        'last_login',
        'registered_at',
    ];

    private static $hashIdsSalt = 'jk58OFzP9l76qV4dloZ6TktKdQrzSJvYAZwAx8voPXc=';
    private static $hashIdsLength = 8;

    public function languagesToLearn()
    {
        return $this->belongsToMany('App\\Models\\Language', 'tandem_learn', 'id_tandemuser', 'id_language');
    }

    public function languagesToTeach()
    {
        return $this->belongsToMany('App\\Models\\Language', 'tandem_teach', 'id_tandemuser', 'id_language');
    }

    public function country()
    {
        return $this->belongsTo('App\\Models\\Country', 'id_country', 'id_country');
    }

    public function getFullNameAttribute()
    {
        if ($this->last_name === null || $this->last_name === '') {
            return $this->first_name;
        }

        return "{$this->first_name} {$this->last_name}";
    }

    public function getPotentialStudentsAttribute()
    {
        return self::active()->orderByRecentLogin()->withLanguages()->whereHas('languagesToLearn', function (Builder $query) {
            $query->whereIn(DB::raw('`tandem_learn`.`id_language`'), $this->languagesToTeach->pluck('id_language'));
        })->get();
    }

    public function getPotentialTeachersAttribute()
    {
        return self::active()->orderByRecentLogin()->withLanguages()->whereHas('languagesToTeach', function (Builder $query) {
            $query->whereIn(DB::raw('`tandem_teach`.`id_language`'), $this->languagesToLearn->pluck('id_language'));
        })->get();
    }

    public function getPotentialPartnersAttribute()
    {
        return $this->potentialStudents->intersect($this->potentialTeachers);
    }

    public function getHashIdAttribute()
    {
        return (new Hashids(self::$hashIdsSalt, self::$hashIdsLength))->encode($this->id_tandemuser);
    }

    public static function decodeHashId(string $hashId)
    {
        $decoded = (new Hashids(self::$hashIdsSalt, self::$hashIdsLength))->decode($hashId);

        return $decoded[0] ?? null;
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('last_login' , '>=', Carbon::now()->subMonths(self::ACTIVE_THRESHOLD_MONTHS));
    }

    public function scopeWithLanguages(Builder $query)
    {
        return $query->with(['languagesToLearn', 'languagesToTeach']);
    }

    public function scopeOrderByRecentLogin(Builder $query) {
        $query->orderByDesc('last_login');
    }

    public function getAuthPassword()
    {
        if (isset($this->password) && $this->password !== '') {
            return $this->password;
        }

        return $this->passhash;
    }

    public static function generateOldPasshash(array $credintials)
    {
        return hash('sha512', "{$credintials['email']}@{$credintials['password']}");
    }
}
