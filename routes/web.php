<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return redirect(route('packs.index')); });
Route::resource('packs', 'Web\PackController')->only(['index', 'show']);

Auth::routes();
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function() {
    Route::get('', 'Web\UserController@index')->name ('index');
    Route::get('edit', 'Web\UserController@edit')->name ('edit');
    Route::post('update', 'Web\UserController@update')->name ('update');
    Route::resource('packs', 'Web\UserPackController');
});