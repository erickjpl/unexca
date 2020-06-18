<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile\Teacher;
use Faker\Generator as Faker;

$factory->define(Teacher::class, function (Faker $faker) {
	$specialities = array(
		'Educación Especial',
		'Educación Inicial',
		'Educación Básica',
		'Educación Fisica',
		'Educación de Bachillerato',
	);
	
    return [
        'speciality' => $faker->randomElement($specialities),
        'status' => $faker->randomElement(array(
        	'active', 'inactive', 'rejected', 'suspended', 'withdrawal')
    	)
    ];
});
