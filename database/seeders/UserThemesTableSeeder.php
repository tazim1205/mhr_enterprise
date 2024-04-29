<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserThemesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_themes')->delete();
        
        \DB::table('user_themes')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'layout' => 'fluid',
                'sidebar_layout' => 'default',
                'sidebar_position' => 'left',
                'theme' => 'dark',
                'updated_at' => '2023-11-02 11:02:02',
                'user_id' => 1,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'layout' => 'fluid',
                'sidebar_layout' => 'default',
                'sidebar_position' => 'left',
                'theme' => 'dark',
                'updated_at' => '2023-11-02 11:04:14',
                'user_id' => 2,
            ),
        ));
        
        
    }
}