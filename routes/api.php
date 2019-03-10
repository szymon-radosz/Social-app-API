<?php

use Illuminate\Http\Request;

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('uploadUserPhoto', 'UserController@updatePhoto');
Route::post('updateUserInfo', 'UserController@updateUserInfo');
Route::post('setUserFilledInfo', 'UserController@setUserFilledInfo');
Route::post('loadUsersNearCoords', 'UserController@loadUsersNearCoords');

Route::post('saveKid', 'KidController@store');

Route::post('saveHobbyUser', 'HobbyController@store');
Route::get('hobbiesList', 'HobbyController@index');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
});


