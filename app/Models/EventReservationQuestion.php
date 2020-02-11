<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_question
 * @property int $id_event
 * @property int $order
 * @property bool $required
 * @property string $type
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
        'id_event', 'order', 'label', 'description', 'required', 'type', 'data'
    ];

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_event', 'id_event');
    }

    public function answers()
    {
        return $this->hasMany('\App\Models\EventReservationAnswer', 'id_question', 'id_question');
    }

    public function getAnswerByUserAndEvent(int $id_user, int $id_event)
    {
        return $this->answers()
            ->where('id_user', $id_user)
            ->where('id_event', $id_event)
            ->first();
    }

    public function getAnswerDisplayByUserAndEvent(int $id_user, int $id_event, string $defaultValue = '')
    {
        $answer = $this->getAnswerByUserAndEvent($id_user, $id_event);
        return $answer ? $answer->getDisplayValue() : $defaultValue;
    }

    public function getDecodedData()
    {
        return json_decode($this->data);
    }

    public function getOptions()
    {
        return $this->getDecodedData()->options;
    }
}
