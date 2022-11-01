<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    public function  testLoginValidationWorks()
    {
        $this->postJson('api/login')
            ->assertStatus(401)
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function testCannotLoginWithIncorrectEmail()
    {
        $this->postJson('/api/login', [
            'email' => 'idonotexist@test.com',
            'password' => '123456',
        ])->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function testCannotLoginWithIncorrectPassword()
    {
        $user = User::factory()->create();

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'iamwrong',
        ])->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function testAUserCanLogin()
    {
        $user = User::factory()->create();

        $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'helloworld',
        ])->assertOk()
            ->assertJsonStructure(['token']);
    }
}
