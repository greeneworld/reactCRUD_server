<?php

// header('Access-Control-Allow-Origin: *,*');
// header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");*/
// /*header("Accept","application/json");
// header("Content-Type","application/json");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Accept","application/json");
header("Content-Type","application/json");

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

Route::group(['prefix'=> 'auth'],function(){
    Route::post('/login', 'ApiController@login');
    Route::post('/register', 'ApiController@register');
    Route::post('/login/{social}/callback','ApiController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|');
});

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    Route::get('user', 'ApiController@getAuthUser');
    Route::post('changePassword', 'ApiController@changePassword');

    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{id}', 'CategoryController@show');
    Route::post('categories', 'CategoryController@store');
    Route::put('categories/{id}', 'CategoryController@update');
    Route::delete('categories/{id}', 'CategoryController@destroy');

    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');
    Route::post('products', 'ProductController@store');
    Route::put('products/{id}', 'ProductController@update');
    Route::delete('products/{id}', 'ProductController@destroy');
});
