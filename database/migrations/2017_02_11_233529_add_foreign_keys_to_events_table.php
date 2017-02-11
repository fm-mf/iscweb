<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events', function(Blueprint $table)
		{
			$table->foreign('modified_by', 'events_ibfk_1')->references('id_user')->on('people')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_trip', 'events_ibfk_2')->references('id_trip')->on('trips')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events', function(Blueprint $table)
		{
			$table->dropForeign('events_ibfk_1');
			$table->dropForeign('events_ibfk_2');
		});
	}

}
