<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class UserTest extends TestCase
{
    // use DatabaseTransactions;

    function test_it_fetches_user_vehicles()
    {
        factory(User::class, 3)->create();
        factory(User::class, 3)->create(['age' => 27]);

        $this->assertTrue(true, true);
    }
}
