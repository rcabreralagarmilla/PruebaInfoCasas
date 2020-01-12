<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $token = Str::random(60);
        $user = new User;
        $user->username = 'admin';
        $user->role = 'Administrator';
        $user->password = hash('sha256', 'admin');
        $user->save();
    }
}
