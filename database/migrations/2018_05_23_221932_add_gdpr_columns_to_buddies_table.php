<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGdprColumnsToBuddiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buddies', function (Blueprint $table) {
            $table->boolean('agreement');
            $table->boolean('privacy_partak');
            $table->boolean('privacy_buddy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buddies', function (Blueprint $table) {
            $table->dropColumn('agreement');
            $table->dropColumn('privacy_partak');
            $table->dropColumn('privacy_buddy');
        });
    }
}
