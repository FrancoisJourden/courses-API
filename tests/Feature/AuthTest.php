<?php

namespace Tests\Feature;

use Tests\AuthenticatedTest;
use Tests\TestCase;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->post('/api/register', [
            'name' => Str::random(),
            'email' => Str::random() . "@test.com",
            'password' => "test12"
        ])->assertUnauthorized();

        $this->post('/api/login', [
            'email' => AuthenticatedTest::EMAIL,
            'password' => "t"
        ])->assertUnauthorized();

        $this->post('/api/login', [
            'email' => AuthenticatedTest::EMAIL,
            'password' => AuthenticatedTest::PASSWORD
        ])->assertOk()->assertJsonStructure([
            'user',
            'authorisation' => [
                'token',
                'type'
            ]
        ]);

        $this->post('/api/register', [
            'name' => Str::random(),
            'email' => Str::random() . "@test.com",
            'password' => "test12"
        ])->assertCreated();

        $this->post('/api/refresh')->assertOk();

        $this->post('/api/logout')->assertOk();

    }
}
