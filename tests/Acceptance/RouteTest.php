<?php

class RouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHeaderLoginButton()
    {
        $this->visit('/')
             ->see('Lorem')
             ->click('Login')
             ->see('Login')
             ->seePageIs('/login');
    }
}
