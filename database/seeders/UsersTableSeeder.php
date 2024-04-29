<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'branch_id' => 1,
                'create_by' => 1,
                'created_at' => '2023-10-28 11:55:32',
                'deleted_at' => NULL,
                'email' => 'super@admin.com',
                'email_verified_at' => NULL,
                'gender' => 'Male',
                'id' => 1,
                'name' => 'Super Admin',
                'name_bn' => 'সুপার অ্যাডিমন',
                'password' => '$2y$10$tv8vk4xJP3IHyy.hByB4UO02q4nzDSkNT7nZ6xOnDp7lqPyhvBuMK',
                'phone' => '01800000000',
                'profile' => '101350131.png',
                'remember_token' => NULL,
                'updated_at' => '2023-10-31 11:36:34',
            ),
            1 =>
            array (
                'branch_id' => 1,
                'create_by' => 1,
                'created_at' => '2023-10-28 23:20:36',
                'deleted_at' => NULL,
                'email' => 'tanimchy417@gmail.com',
                'email_verified_at' => NULL,
                'gender' => 'Male',
                'id' => 2,
                'name' => 'Sumsul Karim Chowdhury',
                'name_bn' => 'সামছুল করিম চৌধুরী',
                'password' => '$2y$10$DiVOtp7Oop3DXgKy1v6QJu0943gYmaxyKMr.Tu3M8sQ0EdKl1kRau',
                'phone' => '01575434262',
                'profile' => '585274628.png',
                'remember_token' => NULL,
                'updated_at' => '2023-10-31 13:00:34',
            ),
        ));
        $user = User::first();
        $role = Role::first();
        $user->assignRole($role);

    }
}
