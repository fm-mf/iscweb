<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

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
            $file = url('avatars/old/' . $this->id_user);
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
            $avatar = url('avatars/' . $avatar);
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

    public function getSex()
    {
        switch ($this->sex){
            case 'M':
                return 'Male';
            case 'F':
                return 'Female';
            default:
                return 'Hermafrodit';
        }
    }

    public static function getAllDiets()
    {
        $data = \DB::select('describe people diet');
        preg_match('/^enum\((.*)\)$/', $data[0]->Type, $matches);
        foreach( explode(',', $matches[1]) as $value )
        {
            $value = trim( $value, "'" );
            $enum[$value] = $value;
        }
        return $enum;
    }

    public function updateWithIssuesAndDiet(array $attributes = [], array $options = [])
    {
        if(! array_key_exists('diet', $attributes)) $attributes['diet'] = null;
        if(! array_key_exists('medical_issues', $attributes)) $attributes['medical_issues'] = null;
        return $this->update($attributes, $options);
    }

    public function getShortDiet()
    {
        switch ($this->diet)
        {
            case 'Vegetarian':
                return 'V';
            case 'Vegan':
                return 'Vn';
            case 'Fish only':
                return 'F';
            default:
                return '-';
        }

    }

    public function getFullName($lastNameFirst = false)
    {
        if($lastNameFirst)
            return $this->last_name . ' ' . $this->first_name;
        return $this->first_name . ' ' . $this->last_name;
    }

}
