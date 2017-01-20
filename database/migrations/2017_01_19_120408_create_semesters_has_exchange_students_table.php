<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSemestersHasExchangeStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('semesters_has_exchange_students', function(Blueprint $table)
		{
			$table->integer('id_semester')->index('fk_semesters');
			$table->integer('id_user')->unsigned()->index('fk_students');
			$table->primary(['id_semester','id_user']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('semesters_has_exchange_students');
	}

}
