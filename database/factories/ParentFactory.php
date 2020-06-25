<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile\RelativeStudent;
use Faker\Generator as Faker;

$factory->define(RelativeStudent::class, function (Faker $faker) {
    return [
        'family_relationship' => $faker->randomElement(array('mother', 'father', 'representative'))
    ];
});
