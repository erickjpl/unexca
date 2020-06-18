<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\School\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(8),
        'status' => $faker->randomElement(array('active', 'inactive', 'suspended', 'finished'))
    ];
});
