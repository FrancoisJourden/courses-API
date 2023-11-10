<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommissionTest extends AuthenticatedTest
{
    public function test(){
        $this->delete("/api/commissions")->assertNoContent();
        $this->get("/api/commissions/current")->assertOk();
        $this->get('/api/commissions/olds')->assertOk();
        $this->get('/api/commissions')->assertOk();

        $this->delete('/api/commissions')->assertNoContent();

    }
}
