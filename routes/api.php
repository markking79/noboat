<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('packs', 'Api\PackController', ['as' => 'api'])->only(['index', 'show']);

Route::middleware(['auth:api'])->name('api.')->group(function() {
    Route::apiResource('pack_likes', 'Api\PackLikeController')->only(['store', 'destroy']);
});