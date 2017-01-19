<?php

use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('semesters')->delete();
        
        \DB::table('semesters')->insert(array (
            0 => 
            array (
                'id_semester' => 1,
                'semester' => 'fall2014',
            ),
            1 => 
            array (
                'id_semester' => 3,
                'semester' => 'fall2015',
            ),
            2 => 
            array (
                'id_semester' => 6,
                'semester' => 'fall2016',
            ),
            3 => 
            array (
                'id_semester' => 2,
                'semester' => 'spring2015',
            ),
            4 => 
            array (
                'id_semester' => 4,
                'semester' => 'spring2016',
            ),
            5 => 
            array (
                'id_semester' => 7,
                'semester' => 'spring2017',
            ),
            6 => 
            array (
                'id_semester' => 5,
                'semester' => 'test',
            ),
        ));
        
        
    }
}