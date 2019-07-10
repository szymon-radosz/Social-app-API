<?php

use Illuminate\Http\Request;

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('uploadUserPhoto', 'UserController@updatePhoto');
Route::post('updateUserInfo', 'UserController@updateUserInfo');
Route::post('setUserFilledInfo', 'UserController@setUserFilledInfo');
Route::post('loadUsersNearCoords', 'UserController@loadUsersNearCoords');
Route::post('loadUserByName', 'UserController@loadUserByName');
Route::post('loadUserByEmail', 'UserController@loadUserByEmail');
Route::post('loadUsersFilter', 'UserController@loadUsersFilter');
Route::post('setUserMessagesStatus', 'UserController@setUserMessagesStatus');
Route::post('clearUserNotificationsStatus', 'UserController@clearUserNotificationsStatus');

Route::get('password-reset', 'ResetPasswordController@showForm'); //I did not create this controller. it simply displays a view with a form to take the email
Route::post('password-reset', 'ResetPasswordController@sendPasswordResetToken');
Route::post('reset-password/{token}', array('uses' => 'ResetPasswordController@resetPassword', 'as' => 'resetPassword'));

Route::post('saveKid', 'KidController@store');
Route::post('cleanUserKids', 'KidController@cleanUserKids');

Route::post('saveConversation', 'ConversationsController@store');
Route::post('showUserConversations', 'ConversationsController@showUserConversations');
Route::post('showConversationDetails', 'ConversationsController@showConversationDetails');
Route::post('checkIfUsersBelongsToConversation', 'ConversationsController@checkIfUsersBelongsToConversation');
Route::post('loadUserById', 'ConversationsController@loadUserById');

Route::post('saveConversationProduct', 'ConversationsProductController@store');
Route::post('checkIfUsersBelongsToProductConversation', 'ConversationsProductController@checkIfUsersBelongsToProductConversation');

Route::post('saveVote', 'VotesController@store');

Route::post('saveProduct', 'ProductController@store');
Route::post('loadProductBasedOnCoords', 'ProductController@loadProductBasedOnCoords');
Route::post('loadProductBasedOnId', 'ProductController@loadProductBasedOnId');
Route::post('closeProduct', 'ProductController@closeProduct');
Route::get('getCategories', 'ProductController@getCategories');
Route::post('loadUserProductList', 'ProductController@loadUserProductList');
Route::post('loadProductsFilter', 'ProductController@loadProductsFilter');

Route::post('saveMessage', 'MessageController@store');

Route::post('saveHobbyUser', 'HobbyController@store');
Route::get('hobbiesList', 'HobbyController@index');
Route::post('cleanUserHobbies', 'HobbyController@cleanUserHobbies');

Route::get('posts', 'PostsController@index');
Route::post('savePost', 'PostsController@store');
Route::post('savePostComment', 'PostsController@savePostComment');
Route::post('savePostVote', 'PostsController@savePostVote');
Route::post('saveCommentVote', 'PostsController@saveCommentVote');
Route::post('getPostById', 'PostsController@getPostById');
Route::post('getPostByCategoryId', 'PostsController@getPostByCategoryId');
Route::post('getPostCommentsByPostId', 'PostsController@getPostCommentsByPostId');
Route::get('getPostsCategories', 'PostsController@getCategories');

Route::post('inviteFriend', 'FriendsController@inviteFriend');
Route::post('confirmFriend', 'FriendsController@confirmFriend');
Route::post('checkFriend', 'FriendsController@checkFriend');
Route::post('countFriends', 'FriendsController@countFriends');
Route::post('friendsList', 'FriendsController@friendsList');
Route::post('pendingFriendsList', 'FriendsController@pendingFriendsList');

Route::post('loadNotificationByUserId', 'NotificationController@loadNotificationByUserId');
Route::post('addNotification', 'NotificationController@addNotification');
Route::post('clearNotificationByUserId', 'NotificationController@clearNotificationByUserId');

Route::post('saveUserFeedback', 'UserFeedbackController@saveUserFeedback'); 

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
});


