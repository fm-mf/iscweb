<?php

use App\Models\Buddy;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RolesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAssigningPartakRole()
    {
        $buddy = Buddy::find(1);

        $id_user = $buddy->id_user;
        $this->assertNotNull($id_user);

        // no roles should be registered at the moment
        $this->missingFromDatabase('users_roles', ['id_user' => $id_user]);

        $this->assertFalse($buddy->person->user->isPartak());

        $buddy->person->user->addRole('partak');

        $this->seeInDatabase('users_roles', ['id_user' => $id_user]);
        $partakRoleId = \App\Models\Role::where('title', 'partak')->first()->id_role;

        $this->assertNotNull($partakRoleId);

        $roleId = \Illuminate\Support\Facades\DB::table('users_roles')->where('id_user', $id_user)->first();
        $this->assertNotNull($roleId);
        $roleId = $roleId->id_role;

        $this->assertEquals($roleId, $partakRoleId);

        $this->assertTrue($buddy->person->user->hasRole(['partak']));
        $this->assertTrue($buddy->person->user->isPartak());
    }

    public function testAssigningMultipleRolesByRoleId()
    {
        $buddy = Buddy::find(1);

        $id_user = $buddy->id_user;


        $buddy->person->user->addRoles([2, 4, 5]);

        $this->seeInDatabase('users_roles', ['id_user' => $id_user, 'id_role' => 2]);
        $this->seeInDatabase('users_roles', ['id_user' => $id_user, 'id_role' => 4]);
        $this->seeInDatabase('users_roles', ['id_user' => $id_user, 'id_role' => 5]);

        $role = \App\Models\Role::find(4);
        $this->assertTrue($buddy->user->hasRole($role->title));

        $newRole = \App\Models\Role::find(3);
        $this->assertFalse($buddy->user->hasRole($newRole->title));
    }
}
