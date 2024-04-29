<?php

namespace Database\Seeders;

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

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'create_by' => 1,
                'created_at' => '2023-10-28 11:56:10',
                'delete_by' => NULL,
                'deleted_at' => NULL,
                'edit_by' => NULL,
                'guard_name' => 'web',
                'id' => 1,
                'name' => 'Super Admin',
                'name_bn' => 'সুপার অ্যাডমিন',
                'restore_by' => NULL,
                'updated_at' => '2023-10-28 11:56:10',
            ),
            1 =>
            array (
                'create_by' => 1,
                'created_at' => '2023-10-28 11:56:21',
                'delete_by' => NULL,
                'deleted_at' => NULL,
                'edit_by' => NULL,
                'guard_name' => 'web',
                'id' => 2,
                'name' => 'Admin',
                'name_bn' => 'অ্যাডমিন',
                'restore_by' => NULL,
                'updated_at' => '2023-10-28 11:56:21',
            ),
        ));


    }
}
