<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwSettings extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            [
                'key' => 'owTripsEnabled',
                'value' => '0'
            ],
            [
                'key' => 'owTripsRestricted',
                'value' => '1'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')
            ->whereIn('key', ['owTripsEnabled', 'owTripsRestricted'])
            ->delete();
    }
}
