<?php

use Faker\Generator as Faker;

$factory->define(App\PostCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->text($min=5, $max=10)
    ];
});
