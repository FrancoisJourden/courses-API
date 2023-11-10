<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::middleware('auth')->group(function () {
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

    Route::prefix("/articles")->controller(ArticleController::class)->group(function () {
        Route::post('/{itemId}', 'add');
        Route::get('/', 'getAll');
        Route::get('/{id}', 'get');
        Route::put('/{id}', 'update');
        Route::put('/validate/{id}', 'taken');
        Route::delete('/{id}', 'cancel');
    });

});
