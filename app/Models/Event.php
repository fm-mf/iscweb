<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id_event';
    //public $incrementing = false;

    protected $dates = ['datetime_from', 'updated_at', 'created_at', 'visible_from'];

    protected $fillable = [

    ];

    public function modifiedBy()
    {
        return $this->hasOne('\App\Models\Person', 'id_user', 'modified_by');
    }

    public function trip()
    {
        return $this->belongsTo('\App\Models\Trip', 'id_event', 'id_event');
    }

    public static function findAllVisible()
    {
        return Event::with('modifiedBy.user')
            ->whereDate('visible_from', '<=', Carbon::today())
            ->whereDate('datetime_from', '>=', Carbon::today())
            ->get();
    }

    public static function findAll()
    {
        return Event::with('modified_by.user');
    }



}
