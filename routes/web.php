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

Route::get('/redirect/{social}','ApiController@socialLogin')->where('social','facebook|google');

Route::get('{slug}', function() {
    return view('welcome');
})->where('slug', '(?!api)([A-z\d\-\/_.]+)?');

Route::get('/', function () {
    return view('welcome');
});
