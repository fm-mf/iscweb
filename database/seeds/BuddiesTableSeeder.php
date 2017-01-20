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
            'password' => '$2y$10$P6Jrsf45TbSP4CQVTVhQc.McODC3CI2QWVYvq/g8jTZEGqfryUGPi',
            'first_name' => 'Michal',
            'last_name' => 'Neaktivni'
        ]);

        $buddy2 = \App\Models\Buddy::registerBuddy([
            'email' => 'verified@isc.cz',
            'password' => '$2y$10$SI36A8lAIlm/DRO2qilXaOZnxr0l5UcJwSb/7k/LJdzSBCMZjdgaO',
            'first_name' => 'Michal',
            'last_name' => 'Aktivni'
        ]);

        $buddy2->setVerified();
    }
}
