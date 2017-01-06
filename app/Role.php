<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id_role';
    public function users()
    {
        return $this->belongsToMany('\App\User', 'users_roles', 'id_role', 'id_user');
    }
}
