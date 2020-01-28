<?php

Route::name('admin.')->namespace('Admin')->group(function() 
{
    Route::apiResource('/brands', 'BrandsController');
});

Route::get('csrf', function() 
{
    return Session::token();
});