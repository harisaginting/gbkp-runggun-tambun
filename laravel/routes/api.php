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


Route::any('/', function (Request $request) {
    echo "kitapermata.com webservice";
});


Route::namespace('Api')->prefix('v1')->group(function(){
	 Route::any('/', function(){
	 		echo "kitapermata.com webservice version 1";
	 });

	 Route::post('register'	, 'AuthController@register');
	 Route::post('login'	, 'AuthController@login');	 
	 
	 Route::group(['middleware' => 'harisa-api'], function(){
	 	Route::get('user', 'UserController@get');
	 	Route::post('user', 'UserController@update');
	 });
});