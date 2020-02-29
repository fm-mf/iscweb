<?php

use App\Models\Buddy;
use Illuminate\Database\Seeder;

class BuddiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buddy1 = Buddy::registerBuddy([
            'email' => 'unverified@isc.cz',
            'password' => bcrypt(hash('sha512', 'unverified@isc.cz@unverified')),
            'first_name' => 'Michal',
            'last_name' => 'Neaktivni',
            'agreement' => true,
            'id_country' => 61,
        ]);

        $buddy2 = Buddy::registerBuddy([
            'email' => 'verified@isc.cz',
            'password' => bcrypt(hash('sha512', 'verified@isc.cz@verified')),
            'first_name' => 'Michal',
            'last_name' => 'Aktivni',
            'agreement' => true,
            'id_country' => 61,
        ]);
        $buddy2->setVerified();

        $partak3 = Buddy::registerBuddy([
            'email' => 'partak@isc.cz',
            'password' => bcrypt(hash('sha512', 'partak@isc.cz@partak')),
            'first_name' => 'Michal',
            'last_name' => 'Partak',
            'agreement' => true,
            'id_country' => 61,
        ]);
        $partak3->setVerified();
        $partak3->user()->addRole('partak');

        $partak4 = Buddy::registerBuddy([
            'email' => 'supervisor@isc.cz',
            'password' => bcrypt(hash('sha512', 'supervisor@isc.cz@supervisor')),
            'first_name' => 'Michal',
            'last_name' => 'Supervisor',
            'agreement' => true,
            'id_country' => 61,
        ]);
        $partak4->setVerified();
        $partak4->user()->addRole('partak');
        $partak4->user()->addRole('supervisor');
    }
}
