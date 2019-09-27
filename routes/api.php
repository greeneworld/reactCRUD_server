<?php
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
    Route::post('/login/{social}/callback','ApiController@handleProviderCallback')->where('social','facebook|google|');
    //  you can switch as follow by Rpz 2019-09-28
    // Route::post('/login/google/callback','ApiController@handleProviderCallback');
    // Route::post('/login/facebook/callback','ApiController@handleProviderCallback');

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
});
