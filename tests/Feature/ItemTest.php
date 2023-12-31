<?php

namespace Tests\Feature;

use Tests\AuthenticatedTest;

class ItemTest extends AuthenticatedTest
{

    public function test_crud(): void{
        $create = $this->post("/api/items", [
            "name" => "oeufs",
            "category" => "viande"
        ]);

        $create->assertCreated();

        $get = $this->get("/api/items/{$create->original->id}");
        $get->assertOk();

        $update = $this->put("/api/items/{$create->original->id}", ['name' => "beef"]);
        $update->assertOk();
        $update->assertJson(['name'=>"beef"]);

        $delete = $this->delete("/api/items/{$create->original->id}");

        $delete->assertNoContent();
    }

    public function test_get_wrong(): void{
        $response = $this->get('/api/items/5678904567890');
        echo $response->content();
        $response->assertNotFound();
    }
}
