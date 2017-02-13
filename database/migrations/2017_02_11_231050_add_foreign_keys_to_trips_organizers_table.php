<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTripsOrganizersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trips_organizers', function(Blueprint $table)
		{
			$table->foreign('id_trip', 'trips_organizers_ibfk_1')->references('id_trip')->on('trips')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_user', 'trips_organizers_ibfk_2')->references('id_user')->on('people')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('add_by', 'trips_organizers_ibfk_3')->references('id_user')->on('people')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('trips_organizers', function(Blueprint $table)
		{
			$table->dropForeign('trips_organizers_ibfk_1');
			$table->dropForeign('trips_organizers_ibfk_2');
			$table->dropForeign('trips_organizers_ibfk_3');
		});
	}

}
