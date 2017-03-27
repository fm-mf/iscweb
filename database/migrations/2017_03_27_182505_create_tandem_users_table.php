<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTandemUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tandem_users', function(Blueprint $table)
		{
			$table->increments('id_tandemuser');
			$table->string('email', 100);
			$table->char('passhash', 128)->nullable();
			$table->string('first_name', 45)->nullable();
			$table->string('last_name', 45)->nullable();
			$table->smallInteger('id_country')->unsigned()->nullable();
			$table->text('about', 65535)->nullable();
			$table->enum('visible', array('y','n'))->default('y');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tandem_users');
	}

}
