<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->delete();

        DB::table('faculties')->insert([
            [
                'id_faculty' => 1,
                'faculty' => 'Fakulta architektury',
                'abbreviation' => 'FA',
            ],
            [
                'id_faculty' => 2,
                'faculty' => 'Fakulta biomedicínského inženýrství',
                'abbreviation' => 'FBMI',
            ],
            [
                'id_faculty' => 3,
                'faculty' => 'Fakulta dopravní',
                'abbreviation' => 'FD',
            ],
            [
                'id_faculty' => 4,
                'faculty' => 'Fakulta elektrotechnická',
                'abbreviation' => 'FEL',
            ],
            [
                'id_faculty' => 5,
                'faculty' => 'Fakulta informačních technologií',
                'abbreviation' => 'FIT',
            ],
            [
                'id_faculty' => 6,
                'faculty' => 'Fakulta jaderná a fyzikálně inženýrská',
                'abbreviation' => 'FJFI',
            ],
            [
                'id_faculty' => 7,
                'faculty' => 'Fakulta strojní',
                'abbreviation' => 'FS',
            ],
            [
                'id_faculty' => 8,
                'faculty' => 'Fakulta stavební',
                'abbreviation' => 'FSv',
            ],
            [
                'id_faculty' => 9,
                'faculty' => 'Masarykův ústav vyšších studií',
                'abbreviation' => 'MÚVS',
            ],
            [
                'id_faculty' => 10,
                'faculty' => 'Mimo ČVUT',
                'abbreviation' => 'JINE',
            ],
        ]);
    }
}
