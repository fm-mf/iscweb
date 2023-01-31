<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Source: https://help.fit.cvut.cz/rooms/index.html
        // FBMI: https://www.fbmi.cvut.cz/cs/student/rozvrhy

        DB::table('buildings')->insertOrIgnore([
            [
                'code' => 'AL',
                'description' => 'Faculty of Biomedical Engineering (FBMI / FBME) – building Albertov',
                'address' => 'Studničkova 2028/7, Praha 2',
            ],
            [
                'code' => 'DEJ',
                'description' => 'Masaryk Institute of Advanced Studies (MÚVS / MIAS)',
                'address' => 'Kolejní 2637/2a, Praha 6',
            ],
            [
                'code' => 'JP',
                'description' => 'Czech Institute of Informatics, Robotics and Cybernetics (CIIRC)',
                'address' => 'Jugoslávských partyzánů 1580/3, Praha 6',
            ],
            [
                'code' => 'JUL',
                'description' => 'Institute of Physical Education and Sport (ÚTVS)',
                'address' => 'Pod Juliskou 1805/4, Praha 6',
            ],
            [
                'code' => 'KL',
                'description' => 'Faculty of Biomedical Engineering (FBMI / FBME) – building KOKOS',
                'address' => 'náměstí Sítná 3105, Kladno',
            ],
            [
                'code' => 'KL:K',
                'description' => 'Faculty of Biomedical Engineering (FBMI / FBME) – building Kasárna',
                'address' => 'Sportovců 2311, Kladno',
            ],
            [
                'code' => 'KN',
                'description' => 'Faculty of Mechanical Engineering & Faculty of Electrical Engineering (FS & FEL / FME & FEE)',
                'address' => 'Karlovo náměstí 293/13, Praha 2',
            ],
            [
                'code' => 'T2',
                'description' => 'Faculty of Electrical Engineering (FEL / FEE)',
                'address' => 'Technická 1902/2, Praha 6',
            ],
            [
                'code' => 'T4',
                'description' => 'Faculty of Mechanical Engineering (FS / FME)',
                'address' => 'Technická 1902/4, Praha 6',
            ],
            [
                'code' => 'T9',
                'description' => 'Faculty of Architecture & Faculty of Information Technology (FA & FIT)',
                'address' => 'Thákurova 2700/9, Praha 6',
            ],
            [
                'code' => 'TH',
                'description' => 'Faculty of Civil Engineering (FSv / FCE)',
                'address' => 'Thákurova 2077/7, Praha 6',
            ],
            [
                'code' => 'TK',
                'description' => 'National Library of Technology (NTK)',
                'address' => 'Technická 2710/6, Praha 6',
            ],
        ]);
    }
}
