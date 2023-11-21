<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commission;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller {
    public function add(Request $request, int $itemId): JsonResponse {
        $request->validate([
            'quantity' => "integer|gt:0"
        ]);

        $article = Article::create($request->all());
        $article->commission()->associate(Commission::withoutTrashed()->first());
        $article->item()->associate(Item::findOrFail($itemId));
        $article->save();

        return response()->json($article, Response::HTTP_CREATED);
    }

    public function getAll(Request $request) {
        $commission =
            $request->has('commissionId') ? Commission::findOrFail($request->integer('commissionId')) :
                Commission::withoutTrashed()->first();
        $articles = $commission->articles();

        if ($request->has('status')) {
            switch ($request->str('status')) {
                case ('canceled'):
                    $articles->whereNotNull('canceled');
                    break;
                case('taken'):
                    $articles->whereNotNull('taken');
                    break;
                case('remaining'):
                    $articles->whereNull('canceled')->whereNull('taken');
                    break;
                default:
                    abort(Response::HTTP_BAD_REQUEST);
            }
        }

        return $articles->get();
    }

    public function get(Request $request, int $id) {
        return Article::findOrFail($id);
    }

    public function update(Request $request, int $id){
        $request->validate([
            'quantity' => "integer|gt:0"
        ]);

        $article = Article::findOrFail($id);
        $article->update($request->all());

        return response()->json($article);
    }

    public function cancel(Request $request, int $id) {
        $article = Article::findOrFail($id);
        $article->canceled = now();
        $article->save();

        return response()->json($article);
    }

    public function taken(Request $request, int $id) {
        $article = Article::findOrFail($id);
        $article->taken = now();
        $article->save();

        return response()->json($article);
    }
}
