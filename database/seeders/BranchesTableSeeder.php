<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('branches')->delete();

        \DB::table('branches')->insert(array (
            0 =>
            array (
                'id' => 1,
                'branch_name_en' => 'Feni',
                'branch_name_bn' => 'ফেনী',
                'create_by' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-10-28 12:02:24',
                'updated_at' => '2023-10-28 12:02:24',
            ),
        ));


    }
}
