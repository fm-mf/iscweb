<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'id_language' => 1,
                'language' => 'Albanian',
            ],
            [
                'id_language' => 2,
                'language' => 'Arabic',
            ],
            [
                'id_language' => 3,
                'language' => 'Armenian',
            ],
            [
                'id_language' => 4,
                'language' => 'Basque',
            ],
            [
                'id_language' => 5,
                'language' => 'Belarusian',
            ],
            [
                'id_language' => 6,
                'language' => 'Bosnian',
            ],
            [
                'id_language' => 7,
                'language' => 'Bulgarian',
            ],
            [
                'id_language' => 8,
                'language' => 'Catalan',
            ],
            [
                'id_language' => 9,
                'language' => 'Chinese',
            ],
            [
                'id_language' => 10,
                'language' => 'Croatian',
            ],
            [
                'id_language' => 11,
                'language' => 'Czech',
            ],
            [
                'id_language' => 12,
                'language' => 'Danish',
            ],
            [
                'id_language' => 13,
                'language' => 'Dutch',
            ],
            [
                'id_language' => 14,
                'language' => 'English',
            ],
            [
                'id_language' => 15,
                'language' => 'Estonian',
            ],
            [
                'id_language' => 16,
                'language' => 'Finnish',
            ],
            [
                'id_language' => 17,
                'language' => 'French',
            ],
            [
                'id_language' => 18,
                'language' => 'Galician',
            ],
            [
                'id_language' => 19,
                'language' => 'Georgian',
            ],
            [
                'id_language' => 20,
                'language' => 'German',
            ],
            [
                'id_language' => 21,
                'language' => 'Greek',
            ],
            [
                'id_language' => 22,
                'language' => 'Hebrew',
            ],
            [
                'id_language' => 23,
                'language' => 'Hindi',
            ],
            [
                'id_language' => 24,
                'language' => 'Hungarian',
            ],
            [
                'id_language' => 25,
                'language' => 'Indonesian',
            ],
            [
                'id_language' => 26,
                'language' => 'Irish',
            ],
            [
                'id_language' => 27,
                'language' => 'Icelandic',
            ],
            [
                'id_language' => 28,
                'language' => 'Italian',
            ],
            [
                'id_language' => 29,
                'language' => 'Japanese',
            ],
            [
                'id_language' => 30,
                'language' => 'Kazakh',
            ],
            [
                'id_language' => 31,
                'language' => 'Kyrgyz',
            ],
            [
                'id_language' => 32,
                'language' => 'Korean',
            ],
            [
                'id_language' => 33,
                'language' => 'Lithuanian',
            ],
            [
                'id_language' => 34,
                'language' => 'Latvian',
            ],
            [
                'id_language' => 35,
                'language' => 'Macedonian',
            ],
            [
                'id_language' => 36,
                'language' => 'Maltese',
            ],
            [
                'id_language' => 37,
                'language' => 'Norwegian',
            ],
            [
                'id_language' => 38,
                'language' => 'Polish',
            ],
            [
                'id_language' => 39,
                'language' => 'Portuguese',
            ],
            [
                'id_language' => 40,
                'language' => 'Romanian',
            ],
            [
                'id_language' => 41,
                'language' => 'Russian',
            ],
            [
                'id_language' => 42,
                'language' => 'Serbian',
            ],
            [
                'id_language' => 43,
                'language' => 'Slovak',
            ],
            [
                'id_language' => 44,
                'language' => 'Slovene',
            ],
            [
                'id_language' => 45,
                'language' => 'Spanish',
            ],
            [
                'id_language' => 46,
                'language' => 'Swedish',
            ],
            [
                'id_language' => 47,
                'language' => 'Thai',
            ],
            [
                'id_language' => 48,
                'language' => 'Turkish',
            ],
            [
                'id_language' => 49,
                'language' => 'Ukrainian',
            ],
            [
                'id_language' => 50,
                'language' => 'Uzbek',
            ],
            [
                'id_language' => 51,
                'language' => 'Vietnamese',
            ],
            [
                'id_language' => 52,
                'language' => 'Persian (Farsi)',
            ],
        ]);
    }
}
