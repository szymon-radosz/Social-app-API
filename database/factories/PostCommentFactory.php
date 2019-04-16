<?php

use Faker\Generator as Faker;

$factory->define(App\PostComment::class, function (Faker $faker) {
    return [
        'body' => $faker->text(),
        'post_id' => $faker->numberBetween(1,9),
        'user_id' => $faker->numberBetween(1,3)
    ];
});
