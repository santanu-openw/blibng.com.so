<?php

Route::group(['middleware' => ['api'], 'prefix' => 'galleries'], function ($router) {

    $router->get('{type}', 'GalleryController@index');
});
