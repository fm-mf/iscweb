<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTandemUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tandem_users', function (Blueprint $table) {
            $table->string('password')->after('email')->nullable();
            $table->char('preferred_language', 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tandem_users', function (Blueprint $table) {
            $table->dropColumn('preferred_language');
            $table->dropColumn('password');
        });
    }
}
