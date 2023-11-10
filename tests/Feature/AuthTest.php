<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $email = Str::random() . "@test.com";
        $register = $this->post('/api/register', [
            'name' => Str::random(),
            'email' => $email,
            'password' => "test12"
        ])->assertOk();

        $token = $register->original['authorisation']['token'];

        $this->post('/api/login', [
            'email' => $email,
            'password' => "test12"
        ])->assertOk()->assertJsonStructure([
            'user',
            'authorisation' => [
                'token',
                'type'
            ]
        ]);

        $this->post('/api/login', [
            'email' => $email,
            'password' => "t"
        ])->assertUnauthorized();

        $this->post('/api/refresh',[], [
            'Authorization' => "bearer " . $token
        ])->assertOk();

        $this->post('/api/logout',[], [
            'Authorization' => "bearer " . $token
        ])->assertOk();

    }
}
