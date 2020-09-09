<?php

use App\Facades\Settings;
use App\Models\OpeningHoursMode;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOpeningHoursModeInSettingsToId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mode = OpeningHoursMode::where('mode', Settings::get(OpeningHoursMode::SETTINGS_KEY))->first();
        if ($mode) {
            Settings::set(OpeningHoursMode::SETTINGS_KEY, $mode->id_opening_hours_mode);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $mode = OpeningHoursMode::find(Settings::get(OpeningHoursMode::SETTINGS_KEY));
        if ($mode) {
            Settings::set(OpeningHoursMode::SETTINGS_KEY, $mode->mode);
        }
    }
}
