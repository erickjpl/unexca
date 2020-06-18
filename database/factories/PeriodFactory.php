<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\School\Period;
use Faker\Generator as Faker;

$factory->define(Period::class, function (Faker $faker) {
	$grades = array('Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto', 'Sexto');

    return [
        'period_year' => $faker->date($format = 'Y-m-d'),
		'grade' => $faker->randomElement($grades)
    ];
});
