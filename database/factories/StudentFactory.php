<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {	
    return [
        'type' => $faker->randomElement(array('regular', 'repeating', 'retired', 're-entry')),
        'status' => $faker->randomElement(array('active', 'inactive', 'rejected', 'suspended'))
    ];
});
