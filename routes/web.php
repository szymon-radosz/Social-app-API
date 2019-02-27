<?php

/*

Auth::routes();


Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{slug}', function() {
    return view('home');
})
->where('slug', '(?!api)([A-z\d-\/_.]+)?');
 
Route::get('/verifyemail/{token}', 'UserController@verify');

Auth::routes();

Route::middleware('auth.basic')->get('/user', function (Request $request) {
    return Auth::user();
});

