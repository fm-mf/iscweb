<?php

use App\Facades\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWhatsappLinksSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::push('whatsAppAnnoucementsLink', 'https://chat.whatsapp.com/IXGFais1YQ79ev0Jk37aqm');
        Settings::push('whatsAppGeneralLink', 'https://chat.whatsapp.com/EYnWYqOF58Q9M95XFkM1wj');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::delete('whatsAppAnnoucementsLink');
        Settings::delete('whatsAppGeneralLink');
    }
}
