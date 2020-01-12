<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Company;
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

$factory->define(Company::class, function (Faker $faker) {
    $categories = ['Tech', 'Industry', 'Construction', 'Agriculture'];
    return [
        'name' => $faker->company,
        'category' => Arr::random($categories),
        'address' => $faker->address
    ];
});
