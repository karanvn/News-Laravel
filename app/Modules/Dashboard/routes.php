<?php

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth']], function () {

    $module_namespace = "App\Modules\Dashboard\Controllers";
    Route::get('/', [
        'as' => 'Dashboard',
        'uses' =>  'App\Modules\Blog\Controllers\BlogController@list'
    ]);

});

