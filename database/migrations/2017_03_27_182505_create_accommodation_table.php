<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccommodationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accommodation', function(Blueprint $table)
		{
			$table->boolean('id_accommodation')->unique('id_accommodation');
			$table->string('full_name', 45)->unique('accommodation');
			$table->string('full_name_eng', 45);
			$table->char('abbreviation', 4);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accommodation');
	}

}
