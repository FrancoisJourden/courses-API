<?php

namespace Tests\Feature;

use Tests\AuthenticatedTest;

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
