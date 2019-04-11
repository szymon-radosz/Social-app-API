<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HobbyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
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
        $data = [
            'userEmail' => "radoszszymon@gmail.com",
            'hobby_id' => "2222"
        ];

        //$user = factory(\App\User::class)->create();
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
