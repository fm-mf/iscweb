<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key' => 'currentSemester',
                'value' => 'spring2020',
            ],
            [
                'key' => 'isDatabaseOpen',
                'value' => 'false',
            ],
            [
                'key' => 'limitPerDay',
                'value' => '1',
            ],
            [
                'key' => 'rector',
                'value' => 'doc. RNDr. Vojtěch Petráček, CSc.',
            ],
            [
                'key' => 'wcFrom',
                'value' => '06/02/2020',
            ],
            [
                'key' => 'owFrom',
                'value' => '10/02/2020',
            ],
            [
                'key' => 'owTo',
                'value' => '16/02/2020',
            ],
        ]);
    }
}
