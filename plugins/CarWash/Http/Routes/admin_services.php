<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/services'], function ($router) {

    $router->get('', 'ServiceController@index');

    $router->get('/{service}', 'ServiceController@show');

    $router->post('', 'ServiceController@store');

    $router->put('/{service}', 'ServiceController@update');

    $router->delete('/{service}', 'ServiceController@destroy');
});
