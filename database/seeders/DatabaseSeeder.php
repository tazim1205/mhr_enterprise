<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenuLabelsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuActionsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(SoftwareSettingsTableSeeder::class);
        $this->call(UserThemesTableSeeder::class);
        $this->call(CountryInformationsTableSeeder::class);
        $this->call(DivisionInformationsTableSeeder::class);
        $this->call(DistrictInformationsTableSeeder::class);
        $this->call(UpazilaInformationsTableSeeder::class);
    }
}
