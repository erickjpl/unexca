<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\School\Classroom;
use Faker\Generator as Faker;

$factory->define(Classroom::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(array('active', 'inactive', 'suspended', 'finished'))
    ];
});
