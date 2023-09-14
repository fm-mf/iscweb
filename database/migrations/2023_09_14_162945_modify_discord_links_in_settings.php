<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDiscordLinksInSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::push('discordInviteBuddy', '');
        Settings::push('discordInviteExchange', Settings::get('esnPragueDiscord'));
        Settings::delete('esnPragueDiscord');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::push('esnPragueDiscord', Settings::get('discordInviteExchange'));
        Settings::delete('discordInviteExchange');
        Settings::delete('discordInviteBuddy');
    }
}
