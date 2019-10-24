<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_event
 * @property int $id_user
 * @property int $id_question
 * @property string $value
 * @property \App\Models\Event $event
 * @property \App\Models\User $user
 * @property \App\Models\PreregistrationQuestion $question
 */
class PreregistrationResponseQuestion extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_event';

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
        return $this->hasOne('\App\Models\PreregistrationQuestion', 'id_question', 'id_question');
    }
}
