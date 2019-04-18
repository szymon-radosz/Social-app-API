<?php

use Illuminate\Http\Request;

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('uploadUserPhoto', 'UserController@updatePhoto');
Route::post('updateUserInfo', 'UserController@updateUserInfo');
Route::post('setUserFilledInfo', 'UserController@setUserFilledInfo');
Route::post('loadUsersNearCoords', 'UserController@loadUsersNearCoords');
Route::post('loadUserByName', 'UserController@loadUserByName');
Route::post('setUserMessagesStatus', 'UserController@setUserMessagesStatus');

Route::post('saveKid', 'KidController@store');

Route::post('saveConversation', 'ConversationsController@store');
Route::post('showUserConversations', 'ConversationsController@showUserConversations');
Route::post('showConversationDetails', 'ConversationsController@showConversationDetails');
Route::post('checkIfUsersBelongsToConversation', 'ConversationsController@checkIfUsersBelongsToConversation');

Route::post('saveConversationProduct', 'ConversationsProductController@store');
Route::post('checkIfUsersBelongsToProductConversation', 'ConversationsProductController@checkIfUsersBelongsToProductConversation');


Route::post('saveVote', 'VotesController@store');

Route::post('saveProduct', 'ProductController@store');
Route::post('loadProductBasedOnCoords', 'ProductController@loadProductBasedOnCoords');
Route::post('loadProductBasedOnId', 'ProductController@loadProductBasedOnId');
Route::post('closeProduct', 'ProductController@closeProduct');
Route::get('getCategories', 'ProductController@getCategories');

Route::post('saveMessage', 'MessageController@store');

Route::post('saveHobbyUser', 'HobbyController@store');
Route::get('hobbiesList', 'HobbyController@index');

Route::get('posts', 'PostsController@index');
Route::post('savePost', 'PostsController@store');
Route::post('savePostComment', 'PostsController@savePostComment');
Route::post('savePostVote', 'PostsController@savePostVote');
Route::post('saveCommentVote', 'PostsController@saveCommentVote');
Route::post('getPostById', 'PostsController@getPostById');
Route::post('getPostByCategoryId', 'PostsController@getPostByCategoryId');
Route::post('getPostCommentsByPostId', 'PostsController@getPostCommentsByPostId');
Route::get('getCategories', 'PostsController@getCategories');


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
});


