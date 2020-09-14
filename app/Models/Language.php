<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $primaryKey = 'id_language';

    public function tandemTeachers()
    {
        return $this->belongsToMany('App\\Models\\TandemUser', 'tandem_teach', 'id_language', 'id_tandemuser');
    }

    public function tandemStudents()
    {
        return $this->belongsToMany('App\\Models\\TandemUser', 'tandem_learn', 'id_language', 'id_tandemuser');
    }
}
