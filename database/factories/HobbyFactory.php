<?php

use Faker\Generator as Faker;

$factory->define(App\Hobby::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
