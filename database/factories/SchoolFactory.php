<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\School\School;
use Faker\Generator as Faker;

$factory->define(School::class, function (Faker $faker) {
    return [
		'name' => 'José Gil Fortoul',
		'code' => '102030405060708090',
		'phone' => '+58 (212) 871-22-04',
		'address' => 'La Pastpra',
		'creation_date' => now()
    ];
});
