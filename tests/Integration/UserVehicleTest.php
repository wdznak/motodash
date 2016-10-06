<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\UserVehicle;
use App\Models\Refuel;
use Carbon\Carbon;

class UserVehicleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_deletes_user_vehicle()
    {
        $vehicle = factory(UserVehicle::class)->create();
        factory(UserVehicle::class, 3)->create();

        $this->assertCount(4, UserVehicle::all(), "Unexpected vehicles count");

        $vehicle->deleteVehicle();

        $this->assertCount(3, UserVehicle::all(), "Unexpected vehicles count");
    }

    /** @test */
    function it_fetches_refuels_from_last_month()
    {
        $userVehicle = factory(UserVehicle::class)->create();
        $userVehicle->refuels()->save(factory(Refuel::class)->make());
        $userVehicle->refuels()->save(factory(Refuel::class)->make(['created_at' => Carbon::now()->subMonth()]));

        $lastMonthRefuels = $userVehicle->lastMonthRefuels()->get();

        $this->assertCount(1, $lastMonthRefuels, "Unexpected refuels count");
    }
}
