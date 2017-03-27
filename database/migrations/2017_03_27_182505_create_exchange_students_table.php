<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExchangeStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exchange_students', function(Blueprint $table)
		{
			$table->integer('id_user')->unsigned()->primary();
			$table->smallInteger('id_country')->unsigned()->index('fk_countries');
			$table->boolean('id_accommodation')->index('fk_accommodation');
			$table->boolean('id_faculty')->index('fk_faculties');
			$table->integer('id_buddy')->unsigned()->nullable()->index('fk_buddies');
			$table->dateTime('buddy_timestamp')->nullable();
			$table->text('about', 65535)->nullable();
			$table->string('school', 100)->nullable()->default('NULL');
			$table->enum('want_buddy', array('y','n'))->default('y');
			$table->string('phone', 15)->nullable();
			$table->string('esn_card_number', 12)->nullable();
			$table->enum('esn_registered', array('y','n'))->default('n');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exchange_students');
	}

}
