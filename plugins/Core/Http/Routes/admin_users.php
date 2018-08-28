<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {

    $router->get('users', 'UserController@index');

    $router->get('users/{user}', 'UserController@show');

    $router->post('users', 'UserController@store');

    $router->put('users/{user}', 'UserController@update');
    $router->post('users/{user}/update-avatar', 'UserController@updateAvatar');

    $router->delete('users/{user}', 'UserController@destroy');
});
