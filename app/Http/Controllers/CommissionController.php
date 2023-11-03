<?php

namespace App\Http\Controllers;

use App\Models\Commission;

class CommissionController extends Controller
{
    public function getCurrent(){
        return Commission::withoutTrashed()->first();
    }

    public function getOlds(){
        return Commission::onlyTrashed()->get();
    }

    public function getAll(): array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection {
        return Commission::withTrashed()->get();
    }

    public function get(int $id){
        return Commission::find($id);
    }

    public function endCurrent(){
        $current = Commission::withoutTrashed()->first();

        Commission::withoutTrashed()->delete();
        Commission::create([]);

        return response()->json(null, 204);
    }
}
