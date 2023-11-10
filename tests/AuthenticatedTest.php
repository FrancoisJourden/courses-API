<?php

namespace Tests;

class AuthenticatedTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        /*
         * Make sure to have created the user
         */
        $response = $this->post('/api/login', [
            'email' => 'test@test.com',
            'password' => 'test12',
        ]);

        $response->assertOk();
    }
}
