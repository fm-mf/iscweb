<?php

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
        factory(ExchangeStudent::class, 15)->create()->each(function ($s) use ($semester) {
            $s->semesters()->sync([$semester->id_semester]);
        });

        $semester = Semester::where('semester', 'spring2017')->first();
        factory(ExchangeStudent::class, 10)->create()->each(function ($s) use ($semester) {
            $s->semesters()->sync([$semester->id_semester]);
        });
    }
}
