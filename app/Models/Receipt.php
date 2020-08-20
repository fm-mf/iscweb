<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $primaryKey = 'id_receipt';
    protected $dates = ['refunded_at'];

    protected $fillable = [
        'created_by', 'refunded_at', 'refunded_by',
        'subject', 'amount', 'refunded'
    ];

    public function createdBy()
    {
        return $this->belongsTo('\App\Models\User', 'created_by', 'id_user');
    }

    public function refundedBy()
    {
        return $this->belongsTo('\App\Models\User', 'refunded_by', 'id_user');
    }

    public function tripParticipant()
    {
        return $this->hasOne('\App\Models\TripParticipant', 'id_receipt', 'id_receipt');
    }

    public function trip()
    {
        return $this->tripParticipant()->trip();
    }
}
