<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TandemUser extends Authenticatable
{
    protected $primaryKey = 'id_tandemuser';
    protected $guarded = [];
    public $timestamps = false;
    protected $rememberTokenName = false;

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

    public function getAuthPassword()
    {
        if (isset($this->password) && $this->password !== '') {
            return $this->password;
        }

        return $this->passhash;
    }
}
