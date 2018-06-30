<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Application::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'url' => random_int(0, 1) ? $faker->url : '',
        'logo_url' => random_int(0, 1) ? $faker->url : '',
    ];
});
