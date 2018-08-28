<?php

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin/testimonials'], function ($router) {

    $router->get('', 'TestimonialController@index');

    $router->get('/{testimonial}', 'TestimonialController@show');

    $router->post('', 'TestimonialController@store');

    $router->put('/{testimonial}', 'TestimonialController@update');

    $router->delete('/{testimonial}', 'TestimonialController@destroy');
});
