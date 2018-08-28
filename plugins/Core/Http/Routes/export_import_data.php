<?php
Route::group(['namespace' => 'Admin', 'prefix' => 'data-export'], function ($router) {

    $router->get('translations', 'TranslationController@export');

});


Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
    $router->post('translations/import', 'TranslationController@import');

});
