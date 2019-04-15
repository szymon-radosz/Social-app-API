<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        //generate emails with fake domains
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'verified' => 1,
        // md5 generate text like 'de99a620c50f2990e87144735cd357e7'
        'email_token' => $faker->md5,
        'password' => bcrypt($faker->md5),
        'age' => $faker->numberBetween($min = 18, $max = 50),
        //coords in Warsaw, Poland location
        'lattitude' => $faker->randomFloat($min = 52.2, $max = 52.3),
        'longitude' => $faker->randomFloat($min = 20.9, $max = 21.1),
        'description' => $faker->text(100),
        'api_token' => $faker->md5,
        'created_at' => now(),
        'updated_at' => now(),
        'user_filled_info' => 1,
        'photo_path' => time() . '-' . $faker->text(15) . ".jpg",
        'remember_token' => str_random(10),
    ];
});
