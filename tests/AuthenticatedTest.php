<?php

namespace Tests;

class AuthenticatedTest extends TestCase
{
    const EMAIL = "root@localhost";
    const PASSWORD = ""; //TODO fill me

    public function setUp(): void
    {
        parent::setUp();

        /*
         * Make sure to have created the user
         */
        $response = $this->post('/api/login', [
            'email' => AuthenticatedTest::EMAIL,
            'password' => AuthenticatedTest::PASSWORD,
        ]);

        $response->assertOk();
    }
}
