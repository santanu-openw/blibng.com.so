<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/pages'], function ($router) {

    $router->get('', 'PageController@index');

    $router->get('/{page}', 'PageController@show');

    $router->post('', 'PageController@store');

    $router->put('/{page}', 'PageController@update');

    $router->delete('/{page}', 'PageController@destroy');
});


Route::group(['middleware' => ['api'], 'prefix' => 'pages'], function ($router) {
    $router->get('/{page}', 'PageController@show');
});
