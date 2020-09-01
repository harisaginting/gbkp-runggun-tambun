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

// Route::get('/', function () {
//     return view('landing');
// });
// Auth::routes();


Route::post('auth/check_email_avaliable', 'AuthController@checkEmailAvaliable');

Route::post('json/select2-anggota', 'JsonController@select2Anggota');
 

require __DIR__ . '/route_backend.php';

require __DIR__ . '/route_gbkp.php';
require __DIR__ . '/route_permata.php';