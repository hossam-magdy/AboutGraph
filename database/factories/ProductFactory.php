<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'live' => random_int(0, 1) ? random_int(0, 1) : 1,
        'deleted' => random_int(0, 1) ? random_int(0, 1) : 0,
    ];
});
