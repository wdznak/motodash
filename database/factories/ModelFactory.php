<?php

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
        'version' => $faker->realText(20, 1),
        'engine_size' => rand(50, 10000),
        'production_date' => rand(1900, 2016),
    ];
});

$factory->define(App\Models\Refuel::class, function (Faker\Generator $faker) {
    return [
        'price' => rand(10,1000),
        'distance' => rand(10, 1000),
        'fuel_amount' => rand(10,400),
        'user_vehicle_id' => App\Models\UserVehicle::class,
        'petrol_station_id' => App\Models\PetrolStation::class,
        'fuel_type_id' => App\Models\FuelType::class,
    ];
});

$factory->define(App\Models\Modification::class, function (Faker\Generator $faker) {
    return [
        'user_vehicle_id' => App\Models\UserVehicle::class,
        'mod_name' => $faker->realText(20),
        'value' => $faker->sentence(6, true),
        'price' => rand(50, 8000),
    ];
});

$factory->define(App\Models\PetrolStation::class, function (Faker\Generator $faker) {
    return [
        'station_brand' => $faker->bothify('Station #?#?#?' . rand(1, 2000)),
    ];
});

$factory->define(App\Models\FuelType::class, function (Faker\Generator $faker) {
    return [
        'fuel_type' => $faker->bothify('Fuel #?#?#?' . rand(1, 2000)),
    ];
});

$factory->define(App\Models\Vehicle::class, function (Faker\Generator $faker) {
    return [
        'brand' => $faker->bothify('Brand ##??'),
        'model' => $faker->bothify('Model ##??'),
        'type' => $faker->bothify('Type ##??'),
        'produced_from' => rand(1990, 2000),
        'produced_to' => rand(2000, 2016)
    ];
});

$factory->define(App\Models\Gallery::class, function (Faker\Generator $faker) {
    return [
        'user_vehicle_id' => App\Models\UserVehicle::class,
        'vehicle_id' => App\Models\Vehicle::class,
        'gallery_name' => $faker->lexify('Gallery ????'),
        'gallery_description' => $faker->lexify('Desc ????'),
        'thumbnail' => $faker->imageUrl(200, 200),
    ];
});

$factory->define(App\Models\Photo::class, function (Faker\Generator $faker) {
    return [
        'vehicle_id' => App\Models\Vehicle::class,
        'gallery_id' => App\Models\Gallery::class,
        'path' => $faker->imageUrl(640, 480),
    ];
});
