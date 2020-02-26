<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id_role' => 1,
                'title' => 'supervisor',
            ],
            [
                'id_role' => 2,
                'title' => 'partak',
            ],
            [
                'id_role' => 3,
                'title' => 'buddy',
            ],
            [
                'id_role' => 4,
                'title' => 'team',
            ],
            [
                'id_role' => 5,
                'title' => 'board',
            ],
            [
                'id_role' => 6,
                'title' => 'exchange_student',
            ],
            [
                'id_role' => 7,
                'title' => 'admin',
            ],
            [
                'id_role' => 8,
                'title' => 'author',
            ],
            [
                'id_role' => 9,
                'title' => 'samoplatce',
            ],
            [
                'id_role' => 10,
                'title' => 'buddyManager',
            ],
            [
                'id_role' => 11,
                'title' => 'point',
            ],
            [
                'id_role' => 12,
                'title' => 'hr',
            ],
            [
                'id_role' => 13,
                'title' => 'integreatCoordinator',
            ],
        ]);
    }
}
