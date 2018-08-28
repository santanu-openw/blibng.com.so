<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/offers'], function ($router) {

    $router->get('', 'OfferController@index');

    $router->get('/{offer}', 'OfferController@show');

    $router->post('', 'OfferController@store');

    $router->put('/{offer}', 'OfferController@update');

    $router->delete('/{offer}', 'OfferController@destroy');
});
