<?php
Route::group(['middleware' => ['api']], function ($router) {
    $router->get('translations', 'TranslationController@index');

});

