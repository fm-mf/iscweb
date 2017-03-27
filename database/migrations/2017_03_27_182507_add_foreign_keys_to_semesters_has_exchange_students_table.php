<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSemestersHasExchangeStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('semesters_has_exchange_students', function(Blueprint $table)
		{
			$table->foreign('id_semester', 'fk_semesters')->references('id_semester')->on('semesters')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('id_user', 'fk_students')->references('id_user')->on('exchange_students')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('semesters_has_exchange_students', function(Blueprint $table)
		{
			$table->dropForeign('fk_semesters');
			$table->dropForeign('fk_students');
		});
	}

}
