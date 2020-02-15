<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transportation')->insert([
            [
                'id_transportation' => 1,
                'transportation' => 'Jiné',
                'eng' => 'Other',
            ],
            [
                'id_transportation' => 2,
                'transportation' => 'Vlak',
                'eng' => 'Train',
            ],
            [
                'id_transportation' => 3,
                'transportation' => 'Auto',
                'eng' => 'Car',
            ],
            [
                'id_transportation' => 4,
                'transportation' => 'Letadlo',
                'eng' => 'Plane',
            ],
        ]);
    }
}
