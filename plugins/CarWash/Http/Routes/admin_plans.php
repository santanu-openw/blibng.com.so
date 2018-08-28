<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/plans'], function ($router) {

    $router->get('', 'PlanController@index');

    $router->get('/{plan}', 'PlanController@show');

    $router->post('', 'PlanController@store');

    $router->put('/{plan}', 'PlanController@update');

    $router->delete('/{plan}', 'PlanController@destroy');
});
