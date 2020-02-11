<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

/**
 * @property int $id_user
 * @property int $id_event
 * @property int $deleted_by
 * @property string $diet
 * @property string $medical_issues
 * @property string $notes
 * @property string $hash
 * @property Carbon $expires_at
 * @property \App\Models\User $user
 * @property \App\Models\Event $event
 * @property \App\Models\EventReservationAnswer[] $answers
 */
class EventReservation extends Model
{
    use SoftDeletes;
    use Compoships;

    public $timestamps = true;
    public $incrementing = false;
    protected $primaryKey = 'id_event_reservation';

    protected $dates = ['expires_at'];

    protected $fillable = [
        'diet', 'medical_issues', 'notes', 'hash', 'deleted_by'
    ];

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_event', 'id_event');
    }

    public function user()
    {
        return $this->hasOne('\App\Models\User', 'id_user', 'id_user');
    }

    public function answers()
    {
        return $this->hasMany('\App\Models\EventReservationAnswer', ['id_event', 'id_user'], ['id_event', 'id_user']);
    }

    public function save(array $options = [])
    {
        if (!$this->exists && (!isset($this->hash) || $this->hash == null)) {
            $this->hash = $this->generateHash();
        }
        parent::save($options);
    }

    protected function generateHash()
    {
        $hash = Str::random(32);
        if (EventReservation::findByHash($hash)) {
            return $this->generateHash();
        } else {
            return $hash;
        }
    }

    public function expirationDate()
    {
        return $this->expires_at->format('l, F jS H:i');
    }

    public static function findByHash($hash)
    {
        return EventReservation::where('hash', $hash)->first();
    }

    public static function findByUserAndEvent(int $id_user, int $id_event)
    {
        return EventReservation::where('id_user', $id_user)
            ->where('id_event', $id_event);
    }

    public static function findExpired()
    {
        return EventReservation::where('expires_at', '<=', Carbon::now());
    }
}
