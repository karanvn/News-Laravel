<?php

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth', 'can:view admins']], function () {
    $module_namespace = "App\Modules\Mail\Controllers"; 

    Route::group(['prefix' => 'block'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'Block',
            'uses' =>  $module_namespace . '\BlockController@index'
        ]);
        Route::get('/add', [
            'as' => 'BlockAdd',
            'uses' =>  $module_namespace . '\BlockController@add'
        ])->middleware('can:add admins');

        Route::post('/add', [
            'as' => 'BlockAdd',
            'uses' =>  $module_namespace . '\AjaxMailController@processBlock'
        ]);

        Route::get('/edit/{block}', [
            'as' => 'BlockEdit',
            'uses' =>  $module_namespace . '\BlockController@edit'
        ]);

        Route::get('/html', [
            'as' => 'BlockHtml',
            'uses' =>  $module_namespace . '\BlockController@html'
        ]);
    });

    Route::group(['prefix' => 'template'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'Tpl',
            'uses' =>  $module_namespace . '\TplController@index'
        ]);

        Route::get('/add', [
            'as' => 'TplAdd',
            'uses' =>  $module_namespace . '\TplController@add'
        ])->middleware('can:add admins');

        Route::post('/add', [
            'as' => 'TplAdd',
            'uses' =>  $module_namespace . '\AjaxMailController@processTpl'
        ]);

        Route::get('/edit/{tpl}', [
            'as' => 'TplEdit',
            'uses' =>  $module_namespace . '\TplController@edit'
        ]);

        Route::get('/block/{block}', [
            'as' => 'TplAddBlock',
            'uses' =>  $module_namespace . '\AjaxMailController@processTplAddBlock'
        ])->middleware('can:add admins');
    });
});



