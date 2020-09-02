<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Settings;

/**
 * @author Jiri Hajek
 */
class OpeningHoursMode extends Model
{
    const SETTINGS_KEY = 'openingHoursMode';

    const DAYS_OF_WEEK = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'
    ];

    public $timestamps = false;
    protected $primaryKey = "id_opening_hours_mode";
    protected $table = "opening_hours_mode";
    protected $guarded = [];

    protected $casts = [
        'show_hours' => 'boolean',
        'hours_json' => 'array',
    ];

    public static function getCurrentMode() : self
    {
        return self::find(Settings::get(self::SETTINGS_KEY));
    }

    public function setAsCurrent()
    {
        Settings::set(self::SETTINGS_KEY, $this->id_opening_hours_mode);
    }
}
