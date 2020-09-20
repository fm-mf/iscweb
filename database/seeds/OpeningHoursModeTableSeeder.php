<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpeningHoursModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('opening_hours_mode')->delete();

        DB::table('opening_hours_mode')->insert([
            [
                'show_hours' => false,
                'mode' => 'Exam period / Holidays',
                'hours_json' => json_encode([
                    'text' => 'There are no regular opening hours during the exam period or holidays',
                    'textCs' => 'Během prázdnin a zkouškového nemáme pravidelné otevírací hodiny',
                    'hours' => [
                        'Monday' => 'Closed',
                        'Tuesday' => 'Closed',
                        'Wednesday' => 'Closed',
                        'Thursday' => 'Closed',
                        'Friday' => 'Closed',
                        'Saturday' => 'Closed',
                        'Sunday' => 'Closed',
                    ],
                ]),
            ],
            [
                'show_hours' => false,
                'mode' => 'Orientation Week',
                'hours_json' => json_encode([
                    'text' => 'There are no regular opening hours during the Orientation Week',
                    'textCs' => 'Během Orientation Weeku nemáme pravidelné otevírací hodiny',
                    'hours' => [
                        'Monday' => 'Closed',
                        'Tuesday' => 'Closed',
                        'Wednesday' => 'Closed',
                        'Thursday' => 'Closed',
                        'Friday' => 'Closed',
                        'Saturday' => 'Closed',
                        'Sunday' => 'Closed',
                    ],
                ]),
            ],
            [
                'show_hours' => true,
                'mode' => 'Regular hours',
                'hours_json' => json_encode([
                    'text' => null,
                    'textCs' => null,
                    'hours' => [
                        'Monday' => '15:30 – 20:30',
                        'Tuesday' => '15:30 – 20:30',
                        'Wednesday' => '15:30 – 20:30',
                        'Thursday' => '15:30 – 20:30',
                        'Friday' => 'Closed',
                        'Saturday' => 'Closed',
                        'Sunday' => 'Closed',
                    ],
                ]),
            ],
            [
                'show_hours' => false,
                'mode' => 'Other',
                'hours_json' => json_encode([
                    'text' => 'Custom text',
                    'textCs' => 'Vlastní text',
                    'hours' => [
                        'Monday' => 'Closed',
                        'Tuesday' => 'Closed',
                        'Wednesday' => 'Closed',
                        'Thursday' => 'Closed',
                        'Friday' => 'Closed',
                        'Saturday' => 'Closed',
                        'Sunday' => 'Closed',
                    ],
                ]),
            ],
        ]);

        (new ChangeOpeningHoursModeInSettingsToId)->up();
    }
}
