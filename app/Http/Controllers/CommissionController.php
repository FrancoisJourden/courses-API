<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commission;
use Symfony\Component\HttpFoundation\Response;

class CommissionController extends Controller {
    public function getCurrent() {
        return Commission::withoutTrashed()->first();
    }

    public function getOlds() {
        return Commission::onlyTrashed()->get();
    }

    public function getAll() {
        return Commission::withTrashed()->get();
    }

    public function get(int $id) {
        return Commission::find($id);
    }

    public function endCurrent() {
        $articles_keep = Commission::withoutTrashed()->first()->articles->whereNull('taken')->whereNull('canceled');
        Commission::withoutTrashed()->delete();

        $new = Commission::create([]);
        $articles_keep->each(function(Article $oldArticle) use ($new){
            $article = $oldArticle->replicate();
            $article->commission()->associate($new);
            $article->save();

        });

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
