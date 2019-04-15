<?php

//namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testExample()
    {
        $this->assertTrue(true);
    }

    //The setUp() method is called for the first time, which seeds the relevant tables with testing data
    public function setUp() {
        parent::setUp();

        //run migrations
        Artisan::call('migrate'); 

        //does temporarily disable the mass assignment protection of the model, so you can seed all model properties.
        Eloquent::unguard();
    }

    public function testHundredUsersCreated() {
        $users = factory(App\User::class, 110)->make();
        $userCount = count($users) >= 100;
        $this->assertTrue($userCount);
    }
}
