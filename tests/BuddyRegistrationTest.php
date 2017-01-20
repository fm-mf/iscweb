<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BuddyRegistrationTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRelationship()
    {
        $buddies = factory(App\Models\Buddy::class, 3)->make();

        $this->assertEquals(3, count($buddies));
        $this->assertNotNull($buddies[0]);
        $this->assertInstanceOf(\App\Models\Buddy::class, $buddies[0]);
        $this->assertNotNull($buddies[0]->id_user);
        $this->assertInstanceOf(\App\Models\Person::class, $buddies[0]->person);
        $this->assertInstanceOf(\App\Models\User::class, $buddies[0]->person->user);

    }

    public function testBuddyCreation()
    {
        $buddy = \App\Models\Buddy::registerBuddy([
            'email' => 'michal.kral@isc.com',
            'password' => '123455',
            'first_name' => 'Michal',
            'last_name' => 'Kral'
        ]);

        $this->assertInstanceOf(\App\Models\Buddy::class, $buddy);
        $this->assertNotNull($buddy->id_user);

        $this->seeInDatabase('people', [
            'first_name' => 'Michal',
            'last_name' => 'Kral',
        ]);

        $this->seeInDatabase('buddies', [
            'id_user' => $buddy->id_user
        ]);

        $this->seeInDatabase('users', [
            'email' => 'michal.kral@isc.com',
            'password' => '123455'
        ]);

        $this->assertInstanceOf(\App\Models\Person::class, $buddy->person);
        $this->assertInstanceOf(\App\Models\User::class, $buddy->person->user);

        //$this->assertNotNull($buddy->person->hash); //TODO: failing test
    }

    public function testBuddyProfileUpdate()
    {

        \App\Models\Buddy::registerBuddy([
            'email' => 'michal.kral@isc.com',
            'password' => '123455',
            'first_name' => 'Michal',
            'last_name' => 'Kral'
        ]);

        $user = \App\Models\User::where('email', 'michal.kral@isc.com')->first();
        $this->assertNotNull($user);
        $buddy = \App\Models\Buddy::findBuddy($user->id_user);

        $this->assertNotNull($buddy);
        $this->assertInstanceOf(\App\Models\Buddy::class, $buddy);
    }

    public function testRegistrationForm()
    {
        $this->visit('user/register')
            ->type('Michal', 'first_name')
            ->type('Kral', 'last_name')
            ->type('michal.kral@email.cz', 'email')
            ->type('somepassword', 'password')
            ->type('somepassword', 'password_confirmation')
            ->check('kodex')
            ->press('Registrovat')
            ->seePageIs('/user/profile');
    }

    public function testRegistrationFormWithErrors()
    {

        $this->visit('user/register')
            ->type('Michal', 'first_name')
            ->type('Kral', 'last_name')
            //->type('michal.kral@email.cz', 'email')
            ->type('somepassword', 'password')
            ->type('somepassword', 'password_confirmation')
            ->check('kodex')
            ->press('Registrovat')
            ->seePageIs('/user/register');
    }

    public function testBuddyProfileFormWithVerifiableEmail()
    {
        $buddy = \App\Models\Buddy::registerBuddy([
            'email' => 'verifiable@fjfi.cvut.cz',
            'password' => '123455',
            'first_name' => 'Michal',
            'last_name' => 'Kral'
        ]);

        $this->actingAs($buddy->person->user)->visit('user/profile')->seePageIs('user/profile');
        $this->press('Aktualizovat profil')->seePageIs('user/verification-info');
    }

    public function testBuddyProfileFormWithUnverifiableEmail()
    {
        $buddy = \App\Models\Buddy::registerBuddy([
            'email' => 'unverifiable@seznam.cz',
            'password' => '123455',
            'first_name' => 'Michal',
            'last_name' => 'Kral'
        ]);

        $this->actingAs($buddy->person->user)->visit('user/profile')->seePageIs('user/profile');
        $this->press('Aktualizovat profil')->seePageIs('user/verify');
    }


}
