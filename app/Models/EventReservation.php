<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

/**
 * @property int $id_event_reservation
 * @property int $id_user
 * @property int $id_event
 * @property int $deleted_by
 * @property string $diet
 * @property string $medical_issues
 * @property string $notes
 * @property string $hash
 * @property Carbon $expires_at
 * @property boolean $is_confirmed
 * @property \App\Models\User $user
 * @property \App\Models\Event $event
 * @property \App\Models\EventReservationAnswer[] $answers
 */
class EventReservation extends Model
{
    use SoftDeletes;

    public $timestamps = true;
    public $incrementing = false;
    protected $primaryKey = 'id_event_reservation';

    protected $dates = ['expires_at'];

    protected $fillable = [
        'id_event', 'id_user', 'diet', 'medical_issues', 'notes', 'hash', 'deleted_by', 'expires_at', 'is_confirmed'
    ];

    public function event()
    {
        return $this->belongsTo('\App\Models\Event', 'id_event', 'id_event');
    }

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'id_user', 'id_user');
    }

    public function person()
    {
        return $this->belongsTo('\App\Models\Person', 'id_user', 'id_user');
    }

    public function exchangeStudent()
    {
        return $this->belongsTo('\App\Models\ExchangeStudent', 'id_user', 'id_user');
    }

    public function answers()
    {
        return $this->hasMany(
            '\App\Models\EventReservationAnswer',
            'id_event_reservation',
            'id_event_reservation'
        );
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
        return EventReservation::where('expires_at', '<=', Carbon::now())
            ->whereHas('event', function ($query) {
                // Skips reservations for events that already passed
                return $query->where('datetime_from', '>', Carbon::now());
            });
    }
}
