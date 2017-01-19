<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersGalaxyRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_galaxy_roles', function(Blueprint $table)
		{
			$table->foreign('id_galaxy_role', 'users_galaxy_roles_ibfk_2')->references('id_galaxy_role')->on('galaxy_roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_user', 'users_galaxy_roles_ibfk_3')->references('id_user')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_galaxy_roles', function(Blueprint $table)
		{
			$table->dropForeign('users_galaxy_roles_ibfk_2');
			$table->dropForeign('users_galaxy_roles_ibfk_3');
		});
	}

}
