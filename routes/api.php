<?php

use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix("/items")->controller(ItemController::class)->group(function () {
    Route::get("/units", "getUnits");
    Route::get("/categories", "getCategories");

    Route::get("/", "getAll");
    Route::get("/{id}", "get");
    Route::post("/", "create");
    Route::put("/{id}", "update");
    Route::delete("/{id}", "delete");
});

Route::prefix("/commissions")->controller(CommissionController::class)->group(function () {
    Route::get("/current", "getCurrent");
    Route::get("/olds", "getOlds");
    Route::get("/{id}", "get");
    Route::get("/", "getAll");
    Route::delete('/', "endCurrent");
});
