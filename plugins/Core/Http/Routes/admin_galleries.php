<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/galleries'], function ($router) {

    $router->get('', 'GalleryController@index');

    $router->get('/{gallery}', 'GalleryController@show');

    $router->post('', 'GalleryController@store');

    $router->put('/{gallery}', 'GalleryController@update');

    $router->delete('/{gallery}', 'GalleryController@destroy');

    $router->post('/{gallery}/upload-images', 'GalleryController@uploadImages');
    $router->put('/{gallery}/upload-images/{image_id}', 'GalleryController@updateImage');
    $router->delete('/{gallery}/upload-images/{image_id}', 'GalleryController@deleteImage');
});
