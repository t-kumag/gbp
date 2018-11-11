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

Route::prefix('v1/user')->group(function() {
	Route::post('signup', 'Api\UsersController@signup');
	Route::post('login', 'Api\UsersController@login');
	Route::get('logout', 'Api\UsersController@logout');
    Route::get('test', 'Api\UsersController@test')->middleware(['auth.before']);
});

Route::prefix('v1/families')->middleware(['auth.before'])->group(function() {
    Route::post('child', 'Api\FamiliesController@add_child');
});

Route::prefix('v1')->middleware(['auth.before'])->group(function() {
    Route::post('point', 'Api\PointController@add_point');
});
//->middleware(['auth.before'])

//Route::prefix('v1/child')
//
//Route::prefix('v1/point')->group(function() {
//
//}