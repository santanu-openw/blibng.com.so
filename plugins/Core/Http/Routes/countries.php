<?php
Route::group(['middleware' => ['api'], 'prefix' => 'countries'], function ($router) {
    $router->get('', 'CountriesController@allCountries');
    $router->get('{country}', 'CountriesController@getCountryStates');

});
