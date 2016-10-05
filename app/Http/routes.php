<?php

Auth::loginUsingId(1);

Route::auth();
Route::get('/', '\App\Motodash\Dashboard\Controllers\HomeController@index');

Route::resource('user', '\App\Motodash\Users\Controllers\UserController', [
    'only' => [
        'show',
        'destroy',
    ],
]);

Route::resource('user.uservehicle', '\App\Motodash\Users\Controllers\UserVehicleController', [
    'except' => [
        'create',
        'edit',
    ],
]);

Route::resource('uservehicle.refuel', '\App\Motodash\Users\Controllers\RefuelController', [
    'only' => [
        'store',
        'destroy',
    ],
]);

Route::resource('uservehicle.modification', '\App\Motodash\Users\Controllers\ModificationController', [
    'only' => [
        'store',
        'destroy',
    ],
]);

Route::resource('vehicles', '\App\Motodash\Api\Controllers\VehicleController');

Route::resource('petrol-station', '\App\Motodash\Api\Controllers\PetrolStationController');
