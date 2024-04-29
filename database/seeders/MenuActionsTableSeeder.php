<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuActionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_actions')->delete();
        
        \DB::table('menu_actions')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'name_bn' => 'তৈরি করুন',
                'name_en' => 'Create',
                'slug' => 'create',
                'status' => 1,
                'system_name' => 'Create',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'name_bn' => 'দেখুন',
                'name_en' => 'View',
                'slug' => 'index',
                'status' => 1,
                'system_name' => 'View',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'name_bn' => 'তথ্য',
                'name_en' => 'Show',
                'slug' => 'show',
                'status' => 1,
                'system_name' => 'Show',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'name_bn' => 'সম্পাদন',
                'name_en' => 'Edit',
                'slug' => 'edit',
                'status' => 1,
                'system_name' => 'Edit',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'id' => 5,
                'name_bn' => 'মুছুন',
                'name_en' => 'Delete',
                'slug' => 'destroy',
                'status' => 1,
                'system_name' => 'Destroy',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'id' => 6,
                'name_bn' => 'ট্রাস',
                'name_en' => 'Trash List',
                'slug' => 'trash',
                'status' => 1,
                'system_name' => 'Trash',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'id' => 7,
                'name_bn' => 'পুনুরুদ্ধার',
                'name_en' => 'Restore',
                'slug' => 'restore',
                'status' => 1,
                'system_name' => 'Restore',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'id' => 8,
                'name_bn' => 'স্থায়ীভাবে মুছুন',
                'name_en' => 'Permenant Delete',
                'slug' => 'delete',
                'status' => 1,
                'system_name' => 'Delete',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => NULL,
                'id' => 9,
                'name_bn' => 'অবস্থান',
                'name_en' => 'Status',
                'slug' => 'status',
                'status' => 1,
                'system_name' => 'Status',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => NULL,
                'id' => 10,
                'name_bn' => 'বিস্তারিত',
                'name_en' => 'Properties',
                'slug' => 'properties',
                'status' => 1,
                'system_name' => 'Properties',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => NULL,
                'id' => 11,
                'name_bn' => 'প্রিন্ট',
                'name_en' => 'Print',
                'slug' => 'print',
                'status' => 1,
                'system_name' => 'Print',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}