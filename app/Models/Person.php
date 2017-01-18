<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_user';
    public $incrementing = false;

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
            if (file_exists(public_path() . '/avatars/old/' . $this->id_user . '.jpg')) {
                $avatar = 'avatars/old/' . $this->id_user . '.jpg';
            } else {
                $avatar = 'img/auth/avatar.jpg';
            }
        } else {
            $avatar = 'avatars/' . $avatar;
        }

        return $avatar;
    }

}
