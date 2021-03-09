<?php

use App\Models\Buddy;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVisitPartaknet()
    {
        $this->visit('/partak')->seePageIs('/user');

        $buddyUnverified = Buddy::find(1); // expects seeded db!
        $this->actingAs($buddyUnverified->user);
        $this->visit('/partak')->seePageIs('/');

        $buddyVerified = Buddy::find(2); // expects seeded db!
        $buddyVerified->user->addRole('partak');
        $this->actingAs($buddyVerified->user);
        $this->visit('partak')->seePageIs('/partak');

    }

    public function testVisitBuddyProgram()
    {
        $this->visit('muj-buddy')->seePageIs('/user');

        $buddyUnverified = Buddy::find(1); // expects seeded db!
        $this->actingAs($buddyUnverified->user);
        $this->visit('/muj-buddy')->seePageIs('/user/verify');

        $buddyVerified = Buddy::find(2); // expects seeded db!

        $this->actingAs($buddyVerified->user);
        $this->visit('/muj-buddy')->seePageIs('/muj-buddy');
    }
}
