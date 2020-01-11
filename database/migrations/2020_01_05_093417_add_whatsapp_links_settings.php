<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddWhatsappLinksSettings extends Migration
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
                'key' => 'whatsAppAnnoucementsLink',
                'value' => ''
            ],
            [
                'key' => 'whatsAppGeneralLink',
                'value' => ''
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
            ->whereIn('key', ['whatsAppAnnoucementsLink', 'whatsAppGeneralLink'])
            ->delete();
    }
}
