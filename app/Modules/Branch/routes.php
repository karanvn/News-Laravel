<?php

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth', 'can:view branches']], function () {
    $module_namespace = "App\Modules\Branch\Controllers";
    Route::group(['prefix' => 'branch'], function () use($module_namespace) {
        Route::get('/list', [
            'as' => 'Branch',
            'uses' =>  $module_namespace . '\BranchController@index'
        ]);

        Route::get('/add', [
            'as' => 'BranchAdd',
            'uses' =>  $module_namespace . '\BranchController@add'
        ]);

        Route::post('/add', [
            'as' => 'BranchAdd',
            'uses' =>  $module_namespace . '\AjaxController@processBranch'
        ]);

        Route::get('/edit/{branch}', [
            'as' => 'BranchEdit',
            'uses' =>  $module_namespace . '\BranchController@edit'
        ])->where('branch', '[0-9]+');

    });
}); 




