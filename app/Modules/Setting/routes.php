<?php

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth', 'can:view admins']], function () {

    $module_namespace = "App\Modules\Setting\Controllers";

    Route::group(['prefix' => 'setting'], function () use($module_namespace) {
        Route::get('/general', [
            'as' => 'SettingGeneral',
            'uses' =>  $module_namespace . '\SettingController@index'
        ]);

        Route::post('/general', [
            'as' => 'SettingGeneral',
            'uses' =>  $module_namespace . '\AjaxSettingController@processGeneral'
        ]);
    });

});



