<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Config\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'path' => $faker->imageUrl(640, 480),
        'size' => '1 mb',
        'type' => '.jpg',
    ];
});
