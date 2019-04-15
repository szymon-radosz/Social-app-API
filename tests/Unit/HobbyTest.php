<?php

//namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HobbyTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testGettingAllHobbies(){
        $response = $this->json('GET', '/api/hobbiesList');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'status',
                'result'
            ]
        );
    }

    public function testSaveHobby(){
        //create factory example user
        $user = factory(App\User::class)->make();

        $data = [
            'userEmail' => $user->email,
            'hobby_id' => "2222"
        ];

        $response = $this->json('POST', '/api/saveHobbyUser', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'status',
                'result'
            ]
        );
    }
}
