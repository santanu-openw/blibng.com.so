<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/blogs'], function ($router) {

    $router->get('', 'BlogController@index');

    $router->get('/{blog}', 'BlogController@show');

    $router->post('', 'BlogController@store');

    $router->put('/{blog}', 'BlogController@update');

    $router->delete('/{blog}', 'BlogController@destroy');
});
