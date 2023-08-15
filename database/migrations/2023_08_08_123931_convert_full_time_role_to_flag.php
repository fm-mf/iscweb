<?php

use App\Models\DegreeBuddy;
use App\Models\DegreeStudent;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConvertFullTimeRoleToFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exchange_students', function (Blueprint $table) {
            $table->boolean('degree_student')->default(false);
        });

        Schema::table('buddies', function (Blueprint $table) {
            $table->boolean('degree_buddy')->default(false);
        });

        DegreeStudent::with('user')->each(function (DegreeStudent $student) {
            $student->markAsDegreeStudent();
            $student->user->removeRole(Role::ID_FULL_TIME);
        });

        DegreeBuddy::with('user')->each(function (DegreeBuddy $buddy) {
            $buddy->markAsDegreeBuddy();
            $buddy->user->removeRole(Role::ID_FULL_TIME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DegreeBuddy::with('user')->get()->each(function (DegreeBuddy $buddy) {
            $buddy->user->addRole(Role::ID_FULL_TIME);
        });

        DegreeStudent::with('user')->get()->each(function (DegreeStudent $student) {
            $student->user->addRole(Role::ID_FULL_TIME);
        });

        Schema::table('buddies', function (Blueprint $table) {
            $table->dropColumn('degree_buddy');
        });

        Schema::table('exchange_students', function (Blueprint $table) {
            $table->dropColumn('degree_student');
        });
    }
}
