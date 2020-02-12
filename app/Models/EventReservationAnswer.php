<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_event
 * @property int $id_user
 * @property int $id_question
 * @property string $value
 * @property \App\Models\Event $event
 * @property \App\Models\User $user
 * @property \App\Models\EventReservationQuestion $question
 */
class EventReservationAnswer extends Model
{
    use Compoships;

    public $timestamps = false;
    protected $primaryKey = 'id_event_reservation_answer';

    protected $fillable = [
        'id_event', 'id_user', 'id_question', 'value'
    ];

    public function event()
    {
        return $this->hasOne('\App\Models\Event', 'id_event', 'id_event');
    }

    public function user()
    {
        return $this->hasOne('\App\Models\User', 'id_user', 'id_user');
    }

    public function question()
    {
        return $this->hasOne('\App\Models\EventReservationQuestion', 'id_question', 'id_question');
    }

    public function getDisplayValue()
    {
        $questionData = \json_decode($this->question->data);
        $actualValue = \json_decode($this->value);
        
        switch ($this->question->type) {
            case 'text':
            case 'number':
                return $actualValue;
            case 'select':
                if (!\is_array($actualValue)) {
                    $actualValue = [$actualValue];
                }

                $options = collect($questionData->options);
                $values = collect($actualValue);

                return \join(
                    ',',
                    $values->map(function ($value) use ($options) {
                        $found = $options->firstWhere('value', $value);
                        if ($found) {
                            return $found->label;
                        }
                        return $value;
                    })->toArray()
                );
            default:
                return $actualValue;
        }
    }
}
