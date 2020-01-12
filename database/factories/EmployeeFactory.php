<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Employee::class, function (Faker $faker) {
    $gender = Arr::random(['male', 'female']);
    return [
        'name' => $faker->firstName($gender),
        'lastName' => $faker->lastName,
        'gender' => $gender,
        'workArea' => $faker->jobTitle,
        'seniority' => $faker->numberBetween(0, 25),
        'salary' => $faker->randomFloat(2, 0, 100000),
    ];
});
