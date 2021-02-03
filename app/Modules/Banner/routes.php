<?php

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth', 'can:view banners']], function () {
    $module_namespace = "App\Modules\Banner\Controllers";
    Route::group(['prefix' => 'banner'], function () use($module_namespace) {
        Route::get('/list', [
            'as' => 'Banner',
            'uses' =>  $module_namespace . '\BannerController@index'
        ]);
        Route::get('/objectAddBanner/{id}', [
            'as' => 'objectAddBanner',
            'uses' =>  $module_namespace . '\AjaxController@objectAddBanner'
        ]);

        Route::get('/add', [
            'as' => 'BannerAdd',
            'uses' =>  $module_namespace . '\BannerController@add'
        ]);

        Route::post('/add', [
            'as' => 'BannerAdd',
            'uses' =>  $module_namespace . '\AjaxController@processBanner'
        ]);

        Route::post('/sort', [
            'as' => 'BannerSort',
            'uses' =>  $module_namespace . '\AjaxController@processSortBanner'
        ]);

        Route::get('/edit/{banner}', [
            'as' => 'BannerEdit',
            'uses' =>  $module_namespace . '\BannerController@edit'
        ])->where('banner', '[0-9]+');

    });
}); 





