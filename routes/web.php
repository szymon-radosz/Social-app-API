<?php

Route::get('/', function () {
    return view('welcome');
});

/*

Auth::routes();


Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
*/
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{slug}', function() {
    return view('home');
})
->where('slug', '(?!api)([A-z\d-\/_.]+)?');
 */
Route::get('/verifyemail/{token}', 'UserController@verify');

Route::get('/reset-password/{token}', 'ResetPasswordController@showPasswordResetForm');

Route::get('/regulamin', 'WebsiteController@terms');


//Auth::routes();
/*
Route::middleware('auth.basic')->get('/user', function (Request $request) {
    return Auth::user();
});*/

