<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAuthProvider extends Model
{
    protected $fillable = [
        'provider',
        'provider_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\\Models\\User', 'id_user', 'id_user');
    }
}
