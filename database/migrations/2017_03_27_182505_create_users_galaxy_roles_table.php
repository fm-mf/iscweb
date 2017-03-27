<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersGalaxyRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_galaxy_roles', function(Blueprint $table)
		{
			$table->integer('id_user')->unsigned()->index('id_user');
			$table->integer('id_galaxy_role')->unsigned()->index('id_galaxy_role');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_galaxy_roles');
	}

}
