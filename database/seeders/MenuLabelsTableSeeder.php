<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuLabelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_labels')->delete();
        
        \DB::table('menu_labels')->insert(array (
            0 => 
            array (
                'create_by' => 1,
                'created_at' => '2023-10-28 12:07:21',
                'delete_by' => NULL,
                'deleted_at' => NULL,
                'edit_by' => 1,
                'id' => 1,
                'label_name_bn' => 'ডেভেলপার',
                'label_name_en' => 'Developers Area',
                'order_by' => 1,
                'restore_by' => NULL,
                'status' => 1,
                'updated_at' => '2023-10-28 12:19:20',
            ),
            1 => 
            array (
                'create_by' => 1,
                'created_at' => '2023-10-28 13:51:41',
                'delete_by' => NULL,
                'deleted_at' => NULL,
                'edit_by' => 1,
                'id' => 2,
                'label_name_bn' => 'সিকিউরিটি',
                'label_name_en' => 'Authentication',
                'order_by' => 2,
                'restore_by' => NULL,
                'status' => 1,
                'updated_at' => '2023-10-30 15:21:06',
            ),
            2 => 
            array (
                'create_by' => 1,
                'created_at' => '2023-10-30 23:54:52',
                'delete_by' => NULL,
                'deleted_at' => NULL,
                'edit_by' => NULL,
                'id' => 6,
                'label_name_bn' => 'সেটিংস',
                'label_name_en' => 'Settings',
                'order_by' => 3,
                'restore_by' => NULL,
                'status' => 1,
                'updated_at' => '2023-10-30 23:54:52',
            ),
        ));
        
        
    }
}