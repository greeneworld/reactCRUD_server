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

Route::get('/redirect/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google');
// Route::get('/', function() {
//     return view('home');
// });
Route::get('{slug}', function() {
    return view('home');
})->where('slug', '(?!api)([A-z\d\-\/_.]+)?');
