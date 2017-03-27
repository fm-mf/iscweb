<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id_user');
			$table->string('email', 100)->unique('email_UNIQUE');
			$table->char('password', 60)->nullable();
			$table->string('galaxy_username')->nullable();
			$table->char('hash', 32)->nullable();
			$table->char('forgotten_password', 32)->nullable();
			$table->char('remember_token', 100)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
