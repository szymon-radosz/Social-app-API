<?php

use Illuminate\Http\Request;

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('uploadUserPhoto', 'UserController@updatePhoto');
Route::post('updateUserInfo', 'UserController@updateUserInfo');
Route::post('setUserFilledInfo', 'UserController@setUserFilledInfo');
Route::post('loadUsersNearCoords', 'UserController@loadUsersNearCoords');
Route::post('setUserMessagesStatus', 'UserController@setUserMessagesStatus');

Route::post('saveKid', 'KidController@store');

Route::post('saveConversation', 'ConversationsController@store');
Route::post('showUserConversations', 'ConversationsController@showUserConversations');
Route::post('showConversationDetails', 'ConversationsController@showConversationDetails');


Route::post('saveMessage', 'MessageController@store');

Route::post('saveHobbyUser', 'HobbyController@store');
Route::get('hobbiesList', 'HobbyController@index');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
});


