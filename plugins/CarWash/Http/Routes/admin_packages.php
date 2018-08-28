<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/packages'], function ($router) {

    $router->get('', 'PackageController@index');

    $router->get('/{package}', 'PackageController@show');

    $router->post('', 'PackageController@store');

    $router->put('/{package}', 'PackageController@update');

    $router->delete('/{package}', 'PackageController@destroy');
});
