<?php

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('uploadUserPhoto', 'UserController@updatePhoto');
Route::post('updateUserInfo', 'UserController@updateUserInfo');
Route::post('setUserFilledInfo', 'UserController@setUserFilledInfo');
Route::post('loadUsersNearCoords', 'UserController@loadUsersNearCoords');
Route::post('loadUserByName', 'UserController@loadUserByName');
Route::post('loadUserByEmail', 'UserController@loadUserByEmail');
Route::post('loadUserDataById', 'UserController@loadUserDataById');
Route::post('loadUsersFilter', 'UserController@loadUsersFilter');
Route::post('setUserMessagesStatus', 'UserController@setUserMessagesStatus');
Route::post('clearUserNotificationsStatus', 'UserController@clearUserNotificationsStatus');
Route::post('checkIfEmailExists', 'UserController@checkIfEmailExists');
Route::post('checkAvailableNickname', 'UserController@checkAvailableNickname');

Route::get('password-reset', 'ResetPasswordController@showForm'); //I did not create this controller. it simply displays a view with a form to take the email
Route::post('password-reset', 'ResetPasswordController@sendPasswordResetToken');
Route::post('reset-password/{token}', array('uses' => 'ResetPasswordController@resetPassword', 'as' => 'resetPassword'));

Route::post('saveConversation', 'ConversationsController@store');
Route::post('showUserConversations', 'ConversationsController@showUserConversations');
Route::post('showConversationDetails', 'ConversationsController@showConversationDetails');
Route::post('checkIfUsersBelongsToConversation', 'ConversationsController@checkIfUsersBelongsToConversation');
Route::post('loadUserById', 'ConversationsController@loadUserById');

Route::post('saveVote', 'VotesController@store');

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'UserController@details');
});

//DASHBOARD
Route::get('get-users', 'Dashboard\DashboardStatsController@getUsers');
Route::get('get-products', 'Dashboard\DashboardStatsController@getProducts');
Route::get('get-forum-posts', 'Dashboard\DashboardStatsController@getForumPosts');
Route::get('get-forum-comments', 'Dashboard\DashboardStatsController@getForumComments');

Route::get('get-users-list', 'Dashboard\DashboardUsersController@getUsers');
Route::post('get-users-by-query', 'Dashboard\DashboardUsersController@getUsersByQuery');
Route::post('block-user', 'Dashboard\DashboardUsersController@blockUser');

Route::get('get-forum-categories', 'Dashboard\DashboardForumCategoriesController@getCategories');
Route::post('update-forum-category', 'Dashboard\DashboardForumCategoriesController@updateCategory');
Route::post('block-forum-category', 'Dashboard\DashboardForumCategoriesController@blockCategory');
Route::post('add-forum-category', 'Dashboard\DashboardForumCategoriesController@addCategory');

Route::get('get-hobbies', 'Dashboard\DashboardHobbyController@getHobbies');
Route::post('update-hobby', 'Dashboard\DashboardHobbyController@updateHobby');
Route::post('block-hobby', 'Dashboard\DashboardHobbyController@blockHobby');
Route::post('add-hobby', 'Dashboard\DashboardHobbyController@addHobby');

Route::get('get-translations', 'Dashboard\DashboardTranslations@getTranslations');
Route::post('update-translation', 'Dashboard\DashboardTranslations@updateTranslation');
Route::post('add-translation', 'Dashboard\DashboardTranslations@addTranslation');
Route::post('remove-translation', 'Dashboard\DashboardTranslations@removeTranslation');
