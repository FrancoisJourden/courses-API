<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ArticleTest extends TestCase {

    public function test_crud(): void {
        $item = $this->post("/api/items", [
            "name" => Str::random(),
            "category" => Str::random()
        ]);
        $item->assertCreated();

        $create = $this->post("/api/articles/{$item->original->id}");
        $create->assertCreated();

        $this->get("/api/articles/{$create->original->id}")->assertOk();
        $this->get('/api/articles')->assertOk();
        $this->get('/api/articles', ['status' => 'remaining'])->assertOk();

        $this->get('/api/articles', ['status' => 'canceled'])->assertOk();
    }

    public function test_taken(): void {
        $item = $this->post("/api/items", [
            "name" => Str::random(),
            "category" => Str::random()
        ]);

        $create = $this->post("/api/articles/{$item->original->id}");
        $create->assertCreated();

        $this->put("/api/articles/validate/{$create->original->id}")->assertOk();

        $this->get("/api/articles/{$create->original->id}")->assertOk();
        $this->get('/api/articles')->assertOk();
        $this->get('/api/articles', ['status' => 'taken'])->assertOk();
    }
}
