<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile\UserDetail;
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

$factory->define(UserDetail::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastname' => $faker->lastName,
        'dni' => $faker->numberBetween(100000,99999999),
        'phone' => $faker->numberBetween(1000000,9999999),
        'birthdate' => now(),
        'address' => $faker->streetAddress,
        'genre' => $faker->randomElement(array('female', 'male')),
    ];
});
