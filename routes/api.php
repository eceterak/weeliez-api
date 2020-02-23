<?php
Route::post('/user', 'AuthController@register');

Route::name('admin.')->namespace('Admin')->middleware('auth.jwt')->prefix('admin')->group(function() {
    Route::apiResource('/brands', 'BrandsController');
    Route::post('/images', 'ImagesController@store');
    Route::delete('/images/{image}', 'ImagesController@destroy');
});

Route::group([], function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/me', 'AuthController@me');
});