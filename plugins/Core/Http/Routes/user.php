<?php
Route::group(['middleware' => ['auth:api']], function ($router) {
    $router->get('user', 'UserController@me');
    $router->post('user/update-password', 'UserController@updatePassword');
    $router->post('user', 'UserController@updateProfile');
    $router->put('user/update-avatar', 'UserController@updateAvatar');

    $router->get('notifications', 'NotificationController@all');
    $router->get('notifications/unread', 'NotificationController@unread');
    $router->get('notifications/mark-as-read', 'NotificationController@markAsRead');

});
