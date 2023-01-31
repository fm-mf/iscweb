<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->insert([
            [
                'id_semester' => 1,
                'semester' => 'fall2014',
            ],
            [
                'id_semester' => 2,
                'semester' => 'spring2015',
            ],
            [
                'id_semester' => 3,
                'semester' => 'fall2015',
            ],
            [
                'id_semester' => 4,
                'semester' => 'spring2016',
            ],
            [
                'id_semester' => 5,
                'semester' => 'test',
            ],
            [
                'id_semester' => 6,
                'semester' => 'fall2016',
            ],
            [
                'id_semester' => 7,
                'semester' => 'spring2017',
            ],
            [
                'id_semester' => 8,
                'semester' => 'fall2017',
            ],
            [
                'id_semester' => 9,
                'semester' => 'spring2018',
            ],
            [
                'id_semester' => 10,
                'semester' => 'fall2018',
            ],
            [
                'id_semester' => 11,
                'semester' => 'spring2019',
            ],
            [
                'id_semester' => 12,
                'semester' => 'fall2019',
            ],
            [
                'id_semester' => 13,
                'semester' => 'spring2020',
            ],
            [
                'id_semester' => 14,
                'semester' => 'fall2020',
            ],
        ]);
    }
}
