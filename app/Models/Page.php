<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Page extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'id_page';

    protected $fillable = [
        'type', 'title', 'content'
    ];

    public function scopeFindByType(Builder $query, string $type)
    {
        return $query->where('type', $type);
    }
}
