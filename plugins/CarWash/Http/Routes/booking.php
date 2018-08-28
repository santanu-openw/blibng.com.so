<?php
Route::group(['middleware' => ['auth:api'], 'prefix' => 'booking'], function ($router) {

    $router->get('packages', 'BookingController@getPackages');
    $router->get('car-sizes', 'BookingController@getCarSizes');
    $router->get('plans', 'BookingController@getPlans');

});
