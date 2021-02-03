<?php

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth']], function () {
    $module_namespace = "App\Modules\PageStatic\Controllers";
    Route::group(['prefix' => 'page_static'], function () use($module_namespace) {
        Route::get('/list', [
            'as' => 'PageStatic',
            'uses' =>  $module_namespace . '\PageStaticController@index'
        ]);

        Route::get('/add', [
            'as' => 'PageStaticAdd',
            'uses' =>  $module_namespace . '\PageStaticController@add'
        ]);

        Route::post('/add', [
            'as' => 'PageStaticAdd',
            'uses' =>  $module_namespace . '\AjaxController@processPageStatic'
        ]);

        Route::post('/sort', [
            'as' => 'PageStaticSort',
            'uses' =>  $module_namespace . '\AjaxController@processSortPageStatic'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'PageStaticEdit',
            'uses' =>  $module_namespace . '\PageStaticController@edit'
        ])->where('page_static', '[0-9]+');

    });
}); 





