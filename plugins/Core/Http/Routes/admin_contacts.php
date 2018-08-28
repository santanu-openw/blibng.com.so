<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/contacts'], function ($router) {

    $router->get('', 'ContactController@index');

    $router->get('/{contact}', 'ContactController@show');

    $router->post('', 'ContactController@store');

    $router->put('/{contact}', 'ContactController@update');

    $router->delete('/{contact}', 'ContactController@destroy');
});
