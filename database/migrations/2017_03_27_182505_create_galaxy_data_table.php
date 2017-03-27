<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalaxyDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('galaxy_data', function(Blueprint $table)
		{
			$table->integer('id_user')->unsigned()->primary();
			$table->string('mail');
			$table->string('sc');
			$table->string('first');
			$table->string('last');
			$table->char('nationality', 2);
			$table->string('picture');
			$table->date('birthdate');
			$table->enum('gender', array('M','F'));
			$table->string('telephone');
			$table->string('address');
			$table->string('section');
			$table->string('country');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('galaxy_data');
	}

}
