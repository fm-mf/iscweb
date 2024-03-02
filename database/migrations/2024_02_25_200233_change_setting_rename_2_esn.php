<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSettingRename2Esn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::set('officialName', 'Erasmus Student Network CTU in Prague, z. s.');
        Settings::set('fullName', 'Erasmus Student Network CTU in Prague');
        Settings::set('shortName', 'ESN CTU in Prague');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::set('officialName', 'International Student Club CTU in Prague, z. s.');
        Settings::set('fullName', 'International Student Club CTU in Prague');
        Settings::set('shortName', 'ISC CTU in Prague');
    }
}
