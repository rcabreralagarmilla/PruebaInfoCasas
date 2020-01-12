<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Company;
use App\Employee;

class CompaniesandEmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Company::class, 50)->create()->each(function ($company) {
            $randomIndex = rand(10, 20);
            $company->employees()->saveMany(factory(Employee::class, $randomIndex)->make());
        });
    }
}
