<?php

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
        $buddy1 = \App\Models\Buddy::registerBuddy([
            'email' => 'unverified@isc.cz',
            'password' => '$2y$10$T15JdffsRjc/kcb8uh.GrexHVrDIqhI98KMYQm0Nj6/9XW6ODHZHO',
            'first_name' => 'Michal',
            'last_name' => 'Neaktivni'
        ]);

        $buddy2 = \App\Models\Buddy::registerBuddy([
            'email' => 'verified@isc.cz',
            'password' => '$2y$10$Y3cFZPR4kOB9o9HqNokzNuXHt3rwyF6k88kXi/XOSUv0IlS6CtJUu',
            'first_name' => 'Michal',
            'last_name' => 'Aktivni'
        ]);

        $buddy2->setVerified();

        $partak3 = \App\Models\Buddy::registerBuddy([
            'email' => 'partak@isc.cz',
            'password' => '$2y$10$nJ45n7saQqWImP0jBBV9S.rjkJ5.AIq.xvh0R4PLYDw0FVMEQYwuG',
            'first_name' => 'Michal',
            'last_name' => 'Partak'
        ]);



        $partak3->setVerified();
        $partak3->user()->addRole('partak');
    }
}
