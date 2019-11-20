<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_question
 * @property int $id_event
 * @property int $order
 * @property bool $required
 * @property string $label
 * @property string $description
 * @property string $data
 * @property \App\Models\Event $event
 */
class EventReservationQuestion extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_question';

    protected $fillable = [
        'id_event', 'order', 'label', 'description', 'required', 'data'
    ];

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_event', 'id_event');
    }
}
