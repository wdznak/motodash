<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'age' => rand(16, 99),
        'avatar' => str_random(10) . '.jpeg',
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\UserVehicle::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\Models\User::class,
        'vehicle_id' => rand(1, 10),
        'thumbnail' => str_random(10) . '.jpeg',
        'mileage' => rand(1, 1000000),
        'version' => $faker->realText($maxNbChars = 20, $indexSize = 1),
        'engine_size' => rand(50, 10000),
        'production_date' => rand(1900, 2016),
    ];
});
