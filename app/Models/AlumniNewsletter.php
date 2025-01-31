<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlumniNewsletter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'date_sent' => 'datetime',
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id_user');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id_user');
    }

    public function deletedBy()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by', 'id_user');
    }

    public function getDateSentFormattedAttribute()
    {
        return $this->date_sent->formatLocalized(__('formatting.full-date'));
    }

    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope('defaultOrder', function (Builder $query) {
            $query->orderByDesc('date_sent')->orderByDesc('id');
        });
    }
}
