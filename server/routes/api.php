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


//Grupo de rutas que tienen un middleware jwt.auth
Route::group(['middleware' => ['cors', 'jwt.auth']], function () {
	
	Route::resource('v1/users', 'UserAPIController');

	Route::resource('v1/cars', 'CarAPIController');
	
});




Route::group(['middleware' => ['cors']], function(){
	Route::post('/login', 'AuthController@userAuth');
});