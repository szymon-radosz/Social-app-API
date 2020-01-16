<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verifyemail/{token}', 'UserController@verify');

Route::get('/reset-password/{token}', 'ResetPasswordController@showPasswordResetForm');

Route::get('/dashboard', 'WebsiteController@dashboard');

Route::get('{slug}', function () {
    return view('dashboard');
});
