<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/partners'], function ($router) {

    $router->get('', 'PartnerController@index');

    $router->get('/{partner}', 'PartnerController@show');

    $router->post('', 'PartnerController@store');

    $router->put('/{partner}', 'PartnerController@update');
    $router->post('/{partner}/update-logo', 'PartnerController@updateLogo');

    $router->delete('/{partner}', 'PartnerController@destroy');
});
