<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text($min=10, $max=30),
        'description' => $faker->text($min=20, $max=100),
        'category_id' => $faker->numberBetween(1,9),
        'user_id' => $faker->numberBetween(1,3)
    ];
});
