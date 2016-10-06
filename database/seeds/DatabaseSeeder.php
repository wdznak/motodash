<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 10)->create()
            ->each(function($user) {
                $userVehicle = factory(App\Models\UserVehicle::class)->create();

                $userVehicle->refuels()->save(factory(App\Models\Refuel::class)->make());

                $user->userVehicles()
                     ->save($userVehicle);
            });
    }
}
