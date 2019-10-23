<?php

namespace App\Models;

use App\Traits\DynamicHiddenVisible;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class PreregistrationResponse extends Model
{
    public $timestamps = true;
    public $incrementing = false;
    protected $primaryKey = 'id_event';

    protected $fillable = [
        'id_user', 'medical_issues', 'diet', 'notes'
    ];

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_event', 'id_event');
    }

    public function user()
    {
        return $this->hasOne('\App\Models\User', 'id_user', 'id_user');
    }

    public static function hasUser(int $id_event, int $id) {
        return PreregistrationResponse::where('id_user', $id)->where('id_event', $id_event)->exists();
    }

    public static function findByUserAndEvent(int $id_user, int $id_event) {
        return PreregistrationResponse::where('id_user', $id_user)->where('id_user', $id_user);
    }
}
