<?php

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

Route::post('/public/login', 'Api\UserLoginController@login')->name('api.user.login');

Route::resource('public/packs', 'Api\PackController')->only(['index', 'show']);

Route::middleware(['auth:api'])->name('api.user.')->group(function() {
    Route::apiResource('user/pack_likes', 'Api\PackLikeController', ['as' => 'user'])->only(['store', 'destroy']);
    Route::apiResource('user/packs', 'Api\UserPackController');
});

// /api/user
// /api/user/login' : api.user.login
// /api/pack_likes/1 : api.user.pack_likes.store
// /api/packs/index : api.user.packs.index


// login at /api/user/login : pass in email, password, remember_me
// - will return a bearer token
// - pass: Authorization Bearer %%TOKEN%%