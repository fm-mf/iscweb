<?php

namespace Database\Seeders;

use App\Models\ExchangeStudent;
use App\Models\Semester;
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
        $semester = Semester::where('semester', 'fall2016')->first();
        ExchangeStudent::factory()->count(15)->create()->each(function ($s) use ($semester) {
            $s->semesters()->sync([$semester->id_semester]);
        });

        $semester = Semester::where('semester', 'spring2017')->first();
        ExchangeStudent::factory()->count(10)->create()->each(function ($s) use ($semester) {
            $s->semesters()->sync([$semester->id_semester]);
        });
    }
}
