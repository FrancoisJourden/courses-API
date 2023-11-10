<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller {

    public function create(Request $request): JsonResponse {
        $item = Item::create($request->all());
        return response()->json($item, Response::HTTP_CREATED);
    }

    public function get(int $id) {
        return Item::findOrFail($id);
    }

    public function getAll(): Collection {
        return Item::all();
    }

    public function getUnits() {
        return response()->json(Item::whereNotNull('unit')->pluck('unit'));
    }

    public function getCategories() {
        return response()->json(Item::whereNotNull('category')->pluck('category'));
    }

    public function update(Request $request, $id): JsonResponse {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        return response()->json($item);
    }

    public function delete(Request $request, $id): JsonResponse {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
