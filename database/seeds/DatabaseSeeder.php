<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccommodationTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(OpeningHoursModeTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(TransportationSeeder::class);

        $this->call(BuddiesTableSeeder::class);
        $this->call(ExchangeStudentsTableSeeder::class);
    }
}
