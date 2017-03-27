<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_roles', function(Blueprint $table)
		{
			$table->foreign('id_role', 'users_roles_ibfk_4')->references('id_role')->on('roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_user', 'users_roles_ibfk_5')->references('id_user')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_roles', function(Blueprint $table)
		{
			$table->dropForeign('users_roles_ibfk_4');
			$table->dropForeign('users_roles_ibfk_5');
		});
	}

}
