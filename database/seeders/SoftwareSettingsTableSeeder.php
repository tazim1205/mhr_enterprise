<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SoftwareSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('software_settings')->delete();
        
        \DB::table('software_settings')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'favicon' => '1897154714.png',
                'id' => 1,
                'logo' => '440971331.png',
                'meta_description' => NULL,
                'meta_tag' => NULL,
                'meta_title' => NULL,
                'title_bn' => 'তানিম ক্রিয়েটিভ ড্যাশবোর্ড',
                'title_en' => 'Tanim Creative Dashboard',
                'updated_at' => '2023-10-31 10:44:24',
            ),
        ));
        
        
    }
}