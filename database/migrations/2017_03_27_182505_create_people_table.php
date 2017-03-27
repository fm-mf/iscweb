<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people', function(Blueprint $table)
		{
			$table->integer('id_user')->unsigned()->index('fk_people_users1');
			$table->string('first_name', 45);
			$table->string('last_name', 45);
			$table->date('age')->nullable();
			$table->enum('sex', array('M','F'))->nullable();
			$table->enum('diet', array('Vegetarian','Vegan','Fish only'))->nullable();
			$table->string('medical_issues')->nullable();
			$table->string('avatar', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('people');
	}

}
