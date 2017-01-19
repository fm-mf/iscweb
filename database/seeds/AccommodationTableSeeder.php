<?php

use Illuminate\Database\Seeder;

class AccommodationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('accommodation')->delete();
        
        \DB::table('accommodation')->insert(array (
            0 => 
            array (
                'id_accommodation' => 1,
                'full_name' => 'Koleje Strahov - 1',
                'full_name_eng' => 'Strahov dormitory - block 1',
                'abbreviation' => 'SH01',
            ),
            1 => 
            array (
                'id_accommodation' => 2,
                'full_name' => 'Koleje Strahov - 2',
                'full_name_eng' => 'Strahov dormitory - block 2',
                'abbreviation' => 'SH02',
            ),
            2 => 
            array (
                'id_accommodation' => 3,
                'full_name' => 'Koleje Strahov - 3',
                'full_name_eng' => 'Strahov dormitory - block 3',
                'abbreviation' => 'SH03',
            ),
            3 => 
            array (
                'id_accommodation' => 4,
                'full_name' => 'Koleje Strahov - 4',
                'full_name_eng' => 'Strahov dormitory - block 4',
                'abbreviation' => 'SH04',
            ),
            4 => 
            array (
                'id_accommodation' => 5,
                'full_name' => 'Koleje Strahov - 5',
                'full_name_eng' => 'Strahov dormitory - block 5',
                'abbreviation' => 'SH05',
            ),
            5 => 
            array (
                'id_accommodation' => 6,
                'full_name' => 'Koleje Strahov - 6',
                'full_name_eng' => 'Strahov dormitory - block 6',
                'abbreviation' => 'SH06',
            ),
            6 => 
            array (
                'id_accommodation' => 7,
                'full_name' => 'Koleje Strahov - 7',
                'full_name_eng' => 'Strahov dormitory - block 7',
                'abbreviation' => 'SH07',
            ),
            7 => 
            array (
                'id_accommodation' => 8,
                'full_name' => 'Koleje Strahov - 8',
                'full_name_eng' => 'Strahov dormitory - block 8',
                'abbreviation' => 'SH08',
            ),
            8 => 
            array (
                'id_accommodation' => 9,
                'full_name' => 'Koleje Strahov - 9',
                'full_name_eng' => 'Strahov dormitory - block 9',
                'abbreviation' => 'SH09',
            ),
            9 => 
            array (
                'id_accommodation' => 10,
                'full_name' => 'Koleje Strahov - 10',
                'full_name_eng' => 'Strahov dormitory - block 10',
                'abbreviation' => 'SH10',
            ),
            10 => 
            array (
                'id_accommodation' => 11,
                'full_name' => 'Koleje Strahov - 11',
                'full_name_eng' => 'Strahov dormitory - block 11',
                'abbreviation' => 'SH11',
            ),
            11 => 
            array (
                'id_accommodation' => 12,
                'full_name' => 'Koleje Strahov - 12',
                'full_name_eng' => 'Strahov dormitory - block 12',
                'abbreviation' => 'SH12',
            ),
            12 => 
            array (
                'id_accommodation' => 13,
                'full_name' => 'Koleje Podolí',
                'full_name_eng' => 'The Podolí Dormitory',
                'abbreviation' => 'KP',
            ),
            13 => 
            array (
                'id_accommodation' => 14,
                'full_name' => 'Dejvická kolej',
                'full_name_eng' => 'The Dejvice Dormitory',
                'abbreviation' => 'DK',
            ),
            14 => 
            array (
                'id_accommodation' => 15,
                'full_name' => 'Kolej Orlík',
                'full_name_eng' => 'The Orlík Dormitory',
                'abbreviation' => 'KO',
            ),
            15 => 
            array (
                'id_accommodation' => 16,
                'full_name' => 'Bubenečská kolej',
                'full_name_eng' => 'The Bubeneč Dormitory',
                'abbreviation' => 'BK',
            ),
            16 => 
            array (
                'id_accommodation' => 17,
                'full_name' => 'Sinkuleho kolej',
                'full_name_eng' => 'The Sinkuleho Dormitory',
                'abbreviation' => 'SK',
            ),
            17 => 
            array (
                'id_accommodation' => 18,
                'full_name' => 'Hlávkova kolej',
                'full_name_eng' => 'The Hlávkova Dormitory',
                'abbreviation' => 'HK',
            ),
            18 => 
            array (
                'id_accommodation' => 19,
                'full_name' => 'Masarykova kolej',
                'full_name_eng' => 'The Masarykova Dormitory',
                'abbreviation' => 'MK',
            ),
            19 => 
            array (
                'id_accommodation' => 20,
                'full_name' => 'Privát',
                'full_name_eng' => 'Private accommodation',
                'abbreviation' => 'PRIV',
            ),
            20 => 
            array (
                'id_accommodation' => 21,
                'full_name' => 'Jiné',
                'full_name_eng' => 'Other',
                'abbreviation' => 'XX',
            ),
        ));
        
        
    }
}