<?php

use Illuminate\Database\Seeder;

class ExchangeStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semester = \App\Models\Semester::where('semester', 'fall2016')->first();
        factory(\App\Models\ExchangeStudent::class, 15)->create()->each(function($s) use($semester) {
            $s->semesters()->sync([$semester->id_semester]);
        });

        $semester = \App\Models\Semester::where('semester', 'spring2017')->first();
        factory(\App\Models\ExchangeStudent::class, 10)->create()->each(function($s) use($semester) {
            $s->semesters()->sync([$semester->id_semester]);
        });
    }
}
