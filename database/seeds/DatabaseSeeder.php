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
            ->each(function($u) {
                $u->userVehicles()
                    ->save(factory(App\Models\UserVehicle::class)->make());
            });
    }
}