<?php

use Illuminate\Database\Seeder;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('transportation')->delete();

        \DB::table('transportation')->insert(array (
            0 =>
                array (
                    'id_transportation' => 1,
                    'transportation' => 'Jiné',
                    'eng' => 'Other',
                ),
            1 =>
                array (
                    'id_transportation' => 2,
                    'transportation' => 'Vlak',
                    'eng' => 'Train',
                ),
            2 =>
                array (
                    'id_transportation' => 3,
                    'transportation' => 'Auto',
                    'eng' => 'Car',
                ),
            3 =>
                array (
                    'id_transportation' => 4,
                    'transportation' => 'Letadlo',
                    'eng' => 'Plane',
                )
        ));

    }
}
