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

Route::group(['middleware' => 'prevent-back-history'],function(){
	Route::middleware('auth:api')->post('logout', 'LoginControllerAPI@logout');
	Route::get('/', function() {
		return view('vue.public');
	});
});

// GENERAL USER
// -------------------- AUTH --------------------
Route::post('register', 'UserControllerAPI@store');
Route::post('login', 'LoginControllerAPI@login');
Route::post('password/email', 'LoginControllerAPI@sendResetLinkEmail');
//Route::post('password/reset', 'LoginControllerAPI@resetPassword');

// LOGGED USER
Route::middleware('auth:api')->group(function () {
	
	// -------------------- USERS --------------------
	Route::get('/user', function (Request $request) {
		return $request->user();
	});
});