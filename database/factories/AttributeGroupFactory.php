<?php

use Faker\Generator as Faker;

$factory->define(App\Models\AttributeGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
