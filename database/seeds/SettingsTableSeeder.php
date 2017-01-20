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
                'value' => 'spring2017',
            ),
            1 => 
            array (
                'key' => 'isDatabaseOpen',
                'value' => 'true',
            ),
            2 => 
            array (
                'key' => 'limitPerDay',
                'value' => '3',
            ),
            3 =>
                array (
                    'key' => 'president',
                    'value' => 'Tereza Kadlecová',
                ),
            4 =>
                array (
                    'key' => 'presidentPicture',
                    'value' => 'img/web/contacts/2016fall/buddy.jpg',
                ),
            5 =>
                array (
                    'key' => 'rector',
                    'value' => 'prof. Ing. Petr Konvalinka, CSc.',
                ),
            6 =>
                array (
                    'key' => 'wcFrom',
                    'value' => 'Thursday February 9th',
                ),
            7 =>
                array (
                    'key' => 'owFrom',
                    'value' => 'Monday February 13th',
                ),
            8 =>
                array (
                    'key' => 'owFromTo',
                    'value' => 'February 13th - 19th, 2017',
                )
        ));
        
        
    }
}