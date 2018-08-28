<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/translations'], function ($router) {

    $router->get('', 'TranslationController@index');

    $router->get('/{translate}', 'TranslationController@show');

    $router->post('', 'TranslationController@store');

    $router->put('/{translate}', 'TranslationController@update');

    $router->delete('/{translate}', 'TranslationController@destroy');
});
