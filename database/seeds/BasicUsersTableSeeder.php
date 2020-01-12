<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Company;

class BasicUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        do {     
            $token = Str::random(60);
            $user = new User;
            $user->username = $faker->unique()->firstName;
            $user->role = 'Basic';
            $user->password = hash('sha256', 'password');
            $user->save();
            $id = $user->id;
            $randomIndex = rand(0, 5);
            $companies = Company::whereNull('user_id')->take($randomIndex)->get();
            foreach ($companies as $company) {
                $company->user_id = $id;
                $company->save();
            }
            $companies = Company::whereNull('user_id')->get();
        } while (count($companies) > 0);
    }
}
