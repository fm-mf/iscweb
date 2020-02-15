<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Buddy;

class ConvertSubscribedColumnInBuddiesTableToBoolean extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buddies', function (Blueprint $table) {
            $table->boolean('subscribed_bool')->default(1)->after('subscribed');
        });

        $buddies = Buddy::where('subscribed', 'n')->get();
        foreach ($buddies as $buddy) {
            $buddy->subscribed_bool = 0;
            $buddy->save();
        }

        Schema::table('buddies', function (Blueprint $table) {
            $table->dropColumn('subscribed');
        });

        DB::statement('ALTER TABLE `buddies` CHANGE COLUMN `subscribed_bool` `subscribed` tinyint(1) NOT NULL DEFAULT \'1\' AFTER `active`;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `buddies` CHANGE COLUMN `subscribed` `subscribed_bool` tinyint(1) NOT NULL DEFAULT \'1\' AFTER `active`;');

        Schema::table('buddies', function (Blueprint $table) {
            $table->enum('subscribed', ['y', 'n'])->default('y')->after('subscribed_bool');
        });

        $buddies = Buddy::where('subscribed_bool', 0)->get();
        foreach ($buddies as $buddy) {
            $buddy->subscribed = 'n';
            $buddy->save();
        }

        Schema::table('buddies', function (Blueprint $table) {
            $table->dropColumn('subscribed_bool');
        });
    }
}
