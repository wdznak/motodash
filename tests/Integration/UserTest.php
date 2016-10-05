<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Models\UserVehicle;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_fetches_user_vehicles()
    {
        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $userVehicle = factory(UserVehicle::class, 3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->userVehicles()->get(), "Unexpected quantity of the user vehicles");
        $this->assertEquals($user->id, $userVehicle->first()->user_id, "Keys mismatching in user and uservehicles table");
        $this->assertEmpty($userTwo->userVehicles()->get(), "User should not have associated vehicles");
    }

    /** @test */
    function it_creates_user_vehicle()
    {
        $vehicleData = [
            'vehicle_id'      => 1,
            'thumbnail'       => '/test/url/thumb.png',
            'mileage'         => 10000,
            'version'         => 'Some fake version',
            'engine_size'     => 600,
            'production_date' => 2000,
        ];

        $user = factory(User::class)->create();
        $user->newVehicle($vehicleData);

        $userVehicle = $user->userVehicles()->get();

        $this->assertCount(1, $userVehicle, "Unexpected quantity of the user vehicles");
        $this->assertEquals($vehicleData['version'], $userVehicle->first()->version);
    }
}
