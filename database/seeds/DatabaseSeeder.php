<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserTableSeeder::class);
        $this->call(CompaniesandEmployeesTableSeeder::class);
        $this->call(BasicUsersTableSeeder::class);
    }
}
