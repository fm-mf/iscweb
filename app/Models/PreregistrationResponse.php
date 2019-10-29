<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        if (PreregistrationResponse::findByHash($hash)) {
            return $this->generateHash();
        } else {
            return $hash;
        }
    }

    public static function findByHash($hash)
    {
        return PreregistrationResponse::where('hash', $hash)->first();
    }

    public static function findByUserAndEvent(int $id_user, int $id_event)
    {
        return PreregistrationResponse::where('id_user', $id_user)->where('id_user', $id_user);
    }
}
