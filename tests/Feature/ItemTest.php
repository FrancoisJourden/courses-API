<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_getAll(): void
    {
        $response = $this->get('/api/items');

        $response->assertStatus(200);
    }

    public function test_crud(): void{
        $create = $this->post("/api/items", [
            "name" => "oeufs",
            "category" => "viande"
        ]);

        $create->assertStatus(201);

        $get = $this->get("/api/items/{$create->original->id}");
        $get->assertStatus(200);

        $update = $this->put("/api/items/{$create->original->id}", ['name' => "beef"]);
        $update->assertStatus(200);
        $update->assertJson(['name'=>"beef"]);

        $delete = $this->delete("/api/items/{$create->original->id}");

        $delete->assertNoContent();
    }

    public function test_get_wrong(): void{
        $response = $this->get('/api/items/24');
        echo $response->content();
        $response->assertNotFound();
    }
}
