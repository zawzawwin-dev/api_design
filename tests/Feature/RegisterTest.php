<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function  testRegisterValidationWorks()
    {
        $this->postJson('api/register')
         ->assertStatus(422)
         ->assertJsonValidationErrors(['name','email','password']);
    }

    public function testAUserCanBeRegistered()
    {
        $this->postJson('api/register',[
            'name'=>"Test",
            'email'=>'test@gmail.com',
            'password'=>'helloworld',
            'password_comfirmation'=>'helloworld'
        ])->assertOk();

       $this->assertDatabaseHas('users',[
        'email'=>'test@gmail.com'
       ]);

    }
}
