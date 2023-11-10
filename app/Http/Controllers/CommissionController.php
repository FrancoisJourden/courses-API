<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Commission;

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
        $articles_keep = Commission::withoutTrashed()->first()->articles;
        Commission::withoutTrashed()->delete();

        $new = Commission::create([]);
        $articles_keep->each(fn($article) => $new->articles->save($article));

        return response()->json(null, 204);
    }
}
