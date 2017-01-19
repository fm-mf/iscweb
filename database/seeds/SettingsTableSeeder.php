<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'key' => 'currentSemester',
                'value' => 'fall2016',
            ),
            1 => 
            array (
                'key' => 'isDatabaseOpen',
                'value' => 'true',
            ),
            2 => 
            array (
                'key' => 'limitPerDay',
                'value' => '1',
            ),
        ));
        
        
    }
}