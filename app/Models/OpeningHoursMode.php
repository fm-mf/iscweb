<?php

namespace App\Models;

use App\Facades\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

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

    public function getHtmlTextAttribute()
    {
        if (app()->isLocale('cs')) {
            $text = $this->hours_json['textCs'] ?? $this->hours_json['text'];
        } else {
            $text = $this->hours_json['text'];
        }

        $text = preg_replace("/\r\n(\r\n)+/", '</p><p>', $text);

        $htmlText = new HtmlString('<p>' . $text . '</p>');

        return $htmlText;
    }
}
