<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToExchangeStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exchange_students', function(Blueprint $table)
		{
			$table->foreign('id_accommodation', 'fk_accommodation')->references('id_accommodation')->on('accommodation')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_buddy', 'fk_buddies')->references('id_user')->on('buddies')->onUpdate('CASCADE')->onDelete('SET NULL');
			$table->foreign('id_country', 'fk_countries')->references('id_country')->on('countries')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_faculty', 'fk_faculties')->references('id_faculty')->on('faculties')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_user', 'fk_people2')->references('id_user')->on('people')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exchange_students', function(Blueprint $table)
		{
			$table->dropForeign('fk_accommodation');
			$table->dropForeign('fk_buddies');
			$table->dropForeign('fk_countries');
			$table->dropForeign('fk_faculties');
			$table->dropForeign('fk_people2');
		});
	}

}
