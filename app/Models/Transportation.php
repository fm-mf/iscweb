<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    protected $table = 'transportation';
    public $timestamps = false;
    protected $primaryKey = 'id_transportation';

    public function arrival()
    {
        return $this->belongsTo('\App\Models\Arrival', 'id_transportation', 'id_transportation');
    }

    public static function getSelectOptionsArray(): array
    {
        return self::all()->mapWithKeys(function (self $transportation) {
            return [$transportation->id_transportation => $transportation->eng];
        })->toArray();
    }
}
