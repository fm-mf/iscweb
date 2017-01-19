<?php

use Illuminate\Database\Seeder;

class FacultiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('faculties')->delete();
        
        \DB::table('faculties')->insert(array (
            0 => 
            array (
                'id_faculty' => 1,
                'faculty' => 'Fakulta architektury',
                'abbreviation' => 'FA',
            ),
            1 => 
            array (
                'id_faculty' => 2,
                'faculty' => 'Fakulta biomedicínského inženýrství',
                'abbreviation' => 'FBMI',
            ),
            2 => 
            array (
                'id_faculty' => 3,
                'faculty' => 'Fakulta dopravní',
                'abbreviation' => 'FD',
            ),
            3 => 
            array (
                'id_faculty' => 4,
                'faculty' => 'Fakulta elektrotechnická',
                'abbreviation' => 'FEL',
            ),
            4 => 
            array (
                'id_faculty' => 5,
                'faculty' => 'Fakulta informačních technologií',
                'abbreviation' => 'FIT',
            ),
            5 => 
            array (
                'id_faculty' => 6,
                'faculty' => 'Fakulta jaderná a fyzikálně inženýrská',
                'abbreviation' => 'FJFI',
            ),
            6 => 
            array (
                'id_faculty' => 7,
                'faculty' => 'Fakulta strojní',
                'abbreviation' => 'FS',
            ),
            7 => 
            array (
                'id_faculty' => 8,
                'faculty' => 'Fakulta stavební',
                'abbreviation' => 'FSv',
            ),
            8 => 
            array (
                'id_faculty' => 9,
                'faculty' => 'Masarykův ústav vyšších studií',
                'abbreviation' => 'MUVS',
            ),
            9 => 
            array (
                'id_faculty' => 10,
                'faculty' => 'Mimo ČVUT',
                'abbreviation' => 'JINE',
            ),
        ));
        
        
    }
}