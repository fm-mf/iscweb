<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id_language' => 1,
                'language' => 'Albanian',
            ),
            1 => 
            array (
                'id_language' => 2,
                'language' => 'Arabic',
            ),
            2 => 
            array (
                'id_language' => 3,
                'language' => 'Armenian',
            ),
            3 => 
            array (
                'id_language' => 4,
                'language' => 'Basque',
            ),
            4 => 
            array (
                'id_language' => 5,
                'language' => 'Belarusian',
            ),
            5 => 
            array (
                'id_language' => 6,
                'language' => 'Bosnian',
            ),
            6 => 
            array (
                'id_language' => 7,
                'language' => 'Bulgarian',
            ),
            7 => 
            array (
                'id_language' => 8,
                'language' => 'Catalan',
            ),
            8 => 
            array (
                'id_language' => 9,
                'language' => 'Chinese',
            ),
            9 => 
            array (
                'id_language' => 10,
                'language' => 'Croatian',
            ),
            10 => 
            array (
                'id_language' => 11,
                'language' => 'Czech',
            ),
            11 => 
            array (
                'id_language' => 12,
                'language' => 'Danish',
            ),
            12 => 
            array (
                'id_language' => 13,
                'language' => 'Dutch',
            ),
            13 => 
            array (
                'id_language' => 14,
                'language' => 'English',
            ),
            14 => 
            array (
                'id_language' => 15,
                'language' => 'Estonian',
            ),
            15 => 
            array (
                'id_language' => 16,
                'language' => 'Finnish',
            ),
            16 => 
            array (
                'id_language' => 17,
                'language' => 'French',
            ),
            17 => 
            array (
                'id_language' => 18,
                'language' => 'Galician',
            ),
            18 => 
            array (
                'id_language' => 19,
                'language' => 'Georgian',
            ),
            19 => 
            array (
                'id_language' => 20,
                'language' => 'German',
            ),
            20 => 
            array (
                'id_language' => 21,
                'language' => 'Greek',
            ),
            21 => 
            array (
                'id_language' => 22,
                'language' => 'Hebrew',
            ),
            22 => 
            array (
                'id_language' => 23,
                'language' => 'Hindi',
            ),
            23 => 
            array (
                'id_language' => 24,
                'language' => 'Hungarian',
            ),
            24 => 
            array (
                'id_language' => 25,
                'language' => 'Indonesian',
            ),
            25 => 
            array (
                'id_language' => 26,
                'language' => 'Irish',
            ),
            26 => 
            array (
                'id_language' => 27,
                'language' => 'Icelandic',
            ),
            27 => 
            array (
                'id_language' => 28,
                'language' => 'Italian',
            ),
            28 => 
            array (
                'id_language' => 29,
                'language' => 'Japanese',
            ),
            29 => 
            array (
                'id_language' => 30,
                'language' => 'Kazakh',
            ),
            30 => 
            array (
                'id_language' => 31,
                'language' => 'Kyrgyz',
            ),
            31 => 
            array (
                'id_language' => 32,
                'language' => 'Korean',
            ),
            32 => 
            array (
                'id_language' => 33,
                'language' => 'Lithuanian',
            ),
            33 => 
            array (
                'id_language' => 34,
                'language' => 'Latvian',
            ),
            34 => 
            array (
                'id_language' => 35,
                'language' => 'Macedonian',
            ),
            35 => 
            array (
                'id_language' => 36,
                'language' => 'Maltese',
            ),
            36 => 
            array (
                'id_language' => 37,
                'language' => 'Norwegian',
            ),
            37 => 
            array (
                'id_language' => 38,
                'language' => 'Polish',
            ),
            38 => 
            array (
                'id_language' => 39,
                'language' => 'Portuguese',
            ),
            39 => 
            array (
                'id_language' => 40,
                'language' => 'Romanian',
            ),
            40 => 
            array (
                'id_language' => 41,
                'language' => 'Russian',
            ),
            41 => 
            array (
                'id_language' => 42,
                'language' => 'Serbian',
            ),
            42 => 
            array (
                'id_language' => 43,
                'language' => 'Slovak',
            ),
            43 => 
            array (
                'id_language' => 44,
                'language' => 'Slovene',
            ),
            44 => 
            array (
                'id_language' => 45,
                'language' => 'Spanish',
            ),
            45 => 
            array (
                'id_language' => 46,
                'language' => 'Swedish',
            ),
            46 => 
            array (
                'id_language' => 47,
                'language' => 'Thai',
            ),
            47 => 
            array (
                'id_language' => 48,
                'language' => 'Turkish',
            ),
            48 => 
            array (
                'id_language' => 49,
                'language' => 'Ukrainian',
            ),
            49 => 
            array (
                'id_language' => 50,
                'language' => 'Uzbek',
            ),
            50 => 
            array (
                'id_language' => 51,
                'language' => 'Vietnamese',
            ),
        ));
        
        
    }
}