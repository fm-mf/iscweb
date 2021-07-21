<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ID_FULL_TIME = 9;

    protected $primaryKey = 'id_role';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('\App\Models\User', 'users_roles', 'id_role', 'id_user');
    }

    public static function fullTime(): self
    {
        return self::find(self::ID_FULL_TIME);
    }
}
