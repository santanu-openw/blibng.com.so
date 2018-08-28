<?php
Route::group(['middleware' => ['api']], function ($router) {
    $router->post('contact', 'ContactController@store');


});
