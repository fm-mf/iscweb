<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_user';
    public $incrementing = false;

    //protected $dates = ['age'];

    protected $fillable = [
        'firs_name', 'last_name', 'age', 'sex', 'diet', 'medical_issues', 'avatar'
    ];

    public function user()
    {
        return $this->hasOne('\App\Models\User', 'id_user', 'id_user');
    }

    public function avatar()
    {
        $avatar = $this->avatar;
        if (!$avatar) {
            $path = public_path() . '/avatars/old/' . $this->id_user;
            $file = url('avatars/old/') . $this->id_user;
            if (file_exists($path . '.jpg')) {
                $avatar = $file . '.jpg';
            } else if (file_exists($path . '.jpeg')) {
                $avatar = $file . '.jpeg';
            } else if (file_exists($path . '.png')) {
                $avatar = $file . '.png';
            } else {
                $avatar = url('/img/auth/avatar.jpg');
            }
        } else {
            $avatar = 'avatars/' . $avatar;
        }

        return $avatar;
    }

    public function setAgeAttribute($age)
    {
        if ($age) {
            $this->attributes['age'] = Carbon::create($age)->year;
        }
    }

    public function getAgeAttribute($value)
    {
        if ($value) {
            return Carbon::createFromFormat('Y', $value)->year;
        } else {
            return null;
        }
    }

}
