<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBuddiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('buddies', function(Blueprint $table)
		{
			$table->foreign('id_faculty', 'buddies_ibfk_2')->references('id_faculty')->on('faculties')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_user', 'fk_people')->references('id_user')->on('people')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('buddies', function(Blueprint $table)
		{
			$table->dropForeign('buddies_ibfk_2');
			$table->dropForeign('fk_people');
		});
	}

}
