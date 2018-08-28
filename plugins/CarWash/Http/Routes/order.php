<?php
Route::group(['middleware' => ['auth:api'], 'prefix' => 'order'], function ($router) {

    $router->get('all', 'OrderController@all');
    $router->get('', 'OrderController@index');
    $router->get('{order}', 'OrderController@show');
    $router->get('{order}/price', 'OrderController@getPrice');
    $router->post('', 'OrderController@store');
    $router->put('{order}', 'OrderController@update');
    $router->delete('{order}', 'OrderController@destroy');

    $router->post('{order}/proceed', 'OrderController@orderProceed');
    $router->post('{order}/completed/{hash}', 'OrderController@completeOrder');

});
