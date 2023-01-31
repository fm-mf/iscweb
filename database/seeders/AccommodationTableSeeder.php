<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccommodationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accommodation')->insert([
            [
                'id_accommodation' => 1,
                'full_name' => 'Koleje Strahov - 1',
                'full_name_eng' => 'Strahov dormitory - block 1',
                'abbreviation' => 'SH01',
            ],
            [
                'id_accommodation' => 2,
                'full_name' => 'Koleje Strahov - 2',
                'full_name_eng' => 'Strahov dormitory - block 2',
                'abbreviation' => 'SH02',
            ],
            [
                'id_accommodation' => 3,
                'full_name' => 'Koleje Strahov - 3',
                'full_name_eng' => 'Strahov dormitory - block 3',
                'abbreviation' => 'SH03',
            ],
            [
                'id_accommodation' => 4,
                'full_name' => 'Koleje Strahov - 4',
                'full_name_eng' => 'Strahov dormitory - block 4',
                'abbreviation' => 'SH04',
            ],
            [
                'id_accommodation' => 5,
                'full_name' => 'Koleje Strahov - 5',
                'full_name_eng' => 'Strahov dormitory - block 5',
                'abbreviation' => 'SH05',
            ],
            [
                'id_accommodation' => 6,
                'full_name' => 'Koleje Strahov - 6',
                'full_name_eng' => 'Strahov dormitory - block 6',
                'abbreviation' => 'SH06',
            ],
            [
                'id_accommodation' => 7,
                'full_name' => 'Koleje Strahov - 7',
                'full_name_eng' => 'Strahov dormitory - block 7',
                'abbreviation' => 'SH07',
            ],
            [
                'id_accommodation' => 8,
                'full_name' => 'Koleje Strahov - 8',
                'full_name_eng' => 'Strahov dormitory - block 8',
                'abbreviation' => 'SH08',
            ],
            [
                'id_accommodation' => 9,
                'full_name' => 'Koleje Strahov - 9',
                'full_name_eng' => 'Strahov dormitory - block 9',
                'abbreviation' => 'SH09',
            ],
            [
                'id_accommodation' => 10,
                'full_name' => 'Koleje Strahov - 10',
                'full_name_eng' => 'Strahov dormitory - block 10',
                'abbreviation' => 'SH10',
            ],
            [
                'id_accommodation' => 11,
                'full_name' => 'Koleje Strahov - 11',
                'full_name_eng' => 'Strahov dormitory - block 11',
                'abbreviation' => 'SH11',
            ],
            [
                'id_accommodation' => 12,
                'full_name' => 'Koleje Strahov - 12',
                'full_name_eng' => 'Strahov dormitory - block 12',
                'abbreviation' => 'SH12',
            ],
            [
                'id_accommodation' => 13,
                'full_name' => 'Koleje Podolí',
                'full_name_eng' => 'The Podolí Dormitory',
                'abbreviation' => 'KP',
            ],
            [
                'id_accommodation' => 14,
                'full_name' => 'Dejvická kolej',
                'full_name_eng' => 'The Dejvice Dormitory',
                'abbreviation' => 'DK',
            ],
            [
                'id_accommodation' => 15,
                'full_name' => 'Kolej Orlík',
                'full_name_eng' => 'The Orlík Dormitory',
                'abbreviation' => 'KO',
            ],
            [
                'id_accommodation' => 16,
                'full_name' => 'Bubenečská kolej',
                'full_name_eng' => 'The Bubeneč Dormitory',
                'abbreviation' => 'BK',
            ],
            [
                'id_accommodation' => 17,
                'full_name' => 'Sinkuleho kolej',
                'full_name_eng' => 'The Sinkuleho Dormitory',
                'abbreviation' => 'SK',
            ],
            [
                'id_accommodation' => 18,
                'full_name' => 'Hlávkova kolej',
                'full_name_eng' => 'The Hlávkova Dormitory',
                'abbreviation' => 'HK',
            ],
            [
                'id_accommodation' => 19,
                'full_name' => 'Masarykova kolej',
                'full_name_eng' => 'The Masarykova Dormitory',
                'abbreviation' => 'MK',
            ],
            [
                'id_accommodation' => 20,
                'full_name' => 'Privát',
                'full_name_eng' => 'Private accommodation',
                'abbreviation' => 'PRIV',
            ],
            [
                'id_accommodation' => 21,
                'full_name' => 'Jiné',
                'full_name_eng' => 'Other',
                'abbreviation' => 'XX',
            ],
        ]);
    }
}
