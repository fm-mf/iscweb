<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $primaryKey = 'id_building';

    public $timestamps = false;

    public function scopeOrderByCode(Builder $query): Builder
    {
        return $query->orderBy('code');
    }
}
