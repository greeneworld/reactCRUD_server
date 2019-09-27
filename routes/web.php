<?php

Route::get('{slug}', function() {
    return view('welcome');
})->where('slug', '(?!api)([A-z\d\-\/_.]+)?');

Route::get('/', function () {
    return view('welcome');
});
