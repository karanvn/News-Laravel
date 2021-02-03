<?php

Route::group(['prefix' => 'admins'], function () {
    Route::group(['middleware' => ['web', 'locale', 'auth']], function () {
        $module_namespace = "App\Modules\Partner\Controllers";
        Route::group(['prefix' => 'partner'], function () use ($module_namespace) {
            Route::get('/list', [
                'as' => 'Partner',
                'uses' =>  $module_namespace . '\PartnerController@index'
            ]);

            Route::get('/add', [
                'as' => 'PartnerAdd',
                'uses' =>  $module_namespace . '\PartnerController@add'
            ]);

            Route::post('/add', [
                'as' => 'PartnerAdd',
                'uses' =>  $module_namespace . '\AjaxController@processPartner'
            ]);

            Route::get('/select', [
                'as' => 'PartnerSelectAdd',
                'uses' =>  $module_namespace . '\AjaxController@processSelectPartner'
            ]);

            Route::get('/edit/{partner}/{page}', [
                'as' => 'PartnerEdit',
                'uses' =>  $module_namespace . '\PartnerController@edit'
            ])->where('partner', '[0-9]+');
        });
    });
});




