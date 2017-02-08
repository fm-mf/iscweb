<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id_role' => 1,
                'title' => 'supervisor',
            ),
            1 => 
            array (
                'id_role' => 2,
                'title' => 'partak',
            ),
            2 => 
            array (
                'id_role' => 3,
                'title' => 'buddy',
            ),
            3 => 
            array (
                'id_role' => 4,
                'title' => 'team',
            ),
            4 => 
            array (
                'id_role' => 5,
                'title' => 'board',
            ),
            5 => 
            array (
                'id_role' => 6,
                'title' => 'exchange_student',
            ),
            6 => 
            array (
                'id_role' => 7,
                'title' => 'admin',
            ),
            7 => 
            array (
                'id_role' => 8,
                'title' => 'author',
            ),
            8 => 
            array (
                'id_role' => 9,
                'title' => 'samoplatce',
            ),
            9 => 
            array (
                'id_role' => 10,
                'title' => 'buddy-manager',
            ),
            10 => 
            array (
                'id_role' => 11,
                'title' => 'point',
            ),
        ));

        \DB::table('roles_inheritance')->insert(array (
            0 =>
                array (
                    'id_role' => 1,
                    'id_inherited_role' => 2,
                ),
            1 => array(
                'id_role' => 1,
                'id_inherited_role' => 10
            ),
        ));
        
    }
}