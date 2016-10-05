<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class HomepageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function when_logged_in_dont_see_login_button()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
             ->visit('/')
             ->dontSee('Login')
             ->see($user->name);

        $this->assertEquals($user->id, Auth::id());
    }

    /** @test */
    public function when_not_authenticated_can_go_to_login_page()
    {
        $this->visit('/')
             ->see('Login')
             ->click('Login')
             ->seePageIs('/login');
    }
}
