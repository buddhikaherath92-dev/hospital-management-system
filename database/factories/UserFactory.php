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
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\DiagnoseValue::class, function (Faker $faker) {
    return [
        'diagnose_id' => 2,
        'hba1c' => $faker->randomFloat(2, 0, 200),
        'cholesterol' => $faker->randomFloat(2,  0, 200),
        'bp' => $faker->randomFloat( 2, 0,  200),
        'created_at' => $faker->dateTimeBetween('-10 months', 'now', 'Asia/Colombo'),
        'updated_at' => $faker->dateTimeBetween('-10 months', 'now', 'Asia/Colombo'),
    ];
});
