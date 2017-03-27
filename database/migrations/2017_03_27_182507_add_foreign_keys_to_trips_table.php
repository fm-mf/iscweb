<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTripsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trips', function(Blueprint $table)
		{
			$table->foreign('modified_by', 'trips_ibfk_1')->references('id_user')->on('people')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_event', 'trips_ibfk_2')->references('id_event')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('trips', function(Blueprint $table)
		{
			$table->dropForeign('trips_ibfk_1');
			$table->dropForeign('trips_ibfk_2');
		});
	}

}
