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

Route::name('api.public.')->group(function() {
    Route::post('/public/login', 'Api\UserLoginController@login')->name('login')->middleware('api_session');
    Route::post('/public/register', 'Api\UserRegisterController@register')->name('register');
});

Route::name('api.public.')->group(function() {
    Route::resource('public/packs', 'Api\PackController')->only(['index', 'show']);
    Route::resource('public/image', 'Api\UploadImageController')->only(['store']);
});

Route::middleware(['auth:api'])->name('api.user.')->group(function() {
    Route::apiResource('user/pack_likes', 'Api\PackLikeController')->only(['store', 'destroy']);
});

Route::middleware(['auth:api'])->name('api.user.')->group(function() {
    Route::apiResource('user/packs', 'Api\UserPackController');
});

Route::name('api.user.')->group(function() {
    Route::apiResource('user/pack_items', 'Api\UserPackItemController');
    Route::apiResource('user/pack_items_sort', 'Api\UserPackItemSortController');
    Route::apiResource('user/pack_auto_completes', 'Api\UserPackAutoCompleteController')->only (['index', 'show']);
});

Route::middleware(['auth:api'])->name('api.admin.')->group(function() {
    Route::apiResource('admin/pack_auto_completes', 'Api\AdminPackAutoCompleteController')->only (['index', 'destroy']);
});

// /api/user
// /api/user/login' : api.user.login
// /api/pack_likes/1 : api.user.pack_likes.store
// /api/packs/index : api.user.packs.index


// login at /api/user/login : pass in email, password, remember_me
// - will return a bearer token
// - pass: Authorization Bearer %%TOKEN%%