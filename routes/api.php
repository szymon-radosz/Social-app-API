<?php

use Illuminate\Http\Request;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/*
Route::post('/kids', 'KidController@store');
*/

/*Route::group(['middleware' => ['web']], function () {
    Route::post('login','Auth\LoginController@login');  
    Route::post('register','Auth\RegisterController@register');  
    Route::post('logout','Auth\LoginController@logout');
    Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail'); 
    Route::post('password/reset','Auth\ResetPasswordController@reset');
       
});*/

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
});