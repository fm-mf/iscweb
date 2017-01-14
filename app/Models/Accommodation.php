<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $table = 'accommodation';
    public $timestamps = false;
    protected $primaryKey = 'id_accommodation';
}
