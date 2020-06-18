<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile\Parent as Parentensco;
use Faker\Generator as Faker;

$factory->define(Parentensco::class, function (Faker $faker) {
    return [
        'family_relationship' => $faker->randomElement(array('mother', 'father', 'representative'))
    ];
});
