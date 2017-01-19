<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGalaxyDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('galaxy_data', function(Blueprint $table)
		{
			$table->foreign('id_user', 'galaxy_data_ibfk_2')->references('id_user')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('galaxy_data', function(Blueprint $table)
		{
			$table->dropForeign('galaxy_data_ibfk_2');
		});
	}

}
