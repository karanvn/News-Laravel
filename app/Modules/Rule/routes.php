<?php

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth', 'can:view admins']], function () {
    $module_namespace = "App\Modules\Rule\Controllers";

    Route::group(['prefix' => 'rule'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'Rule',
            'uses' =>  $module_namespace . '\RuleController@index'
        ]);

        Route::get('/add', [
            'as' => 'RuleAdd',
            'uses' =>  $module_namespace . '\RuleController@add'
        ]);

        Route::post('/add', [
            'as' => 'RuleAdd',
            'uses' =>  $module_namespace . '\AjaxController@processRule'
        ]);

        Route::get('/edit/{rule}', [
            'as' => 'RuleEdit',
            'uses' =>  $module_namespace . '\RuleController@edit'
        ])->where('rule', '[0-9]+');
    });

    Route::group(['prefix' => 'role'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'Role',
            'uses' =>  $module_namespace . '\RoleController@index'
        ]);

        Route::get('/add', [
            'as' => 'RoleAdd',
            'uses' =>  $module_namespace . '\RoleController@add'
        ]);

        Route::post('/add', [
            'as' => 'RoleAdd',
            'uses' =>  $module_namespace . '\AjaxController@processRole'
        ]);

        Route::get('/add_permission', [
            'as' => 'RolePermissionAdd',
            'uses' =>  $module_namespace . '\AjaxController@processRolePermission'
        ]);

        Route::get('/edit/{role}', [
            'as' => 'RoleEdit',
            'uses' =>  $module_namespace . '\RoleController@edit'
        ])->where('role', '[0-9]+');
    });

    Route::group(['prefix' => 'permission'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'Permission',
            'uses' =>  $module_namespace . '\PermissionController@index'
        ]);

        Route::get('/add', [
            'as' => 'PermissionAdd',
            'uses' =>  $module_namespace . '\PermissionController@add'
        ]);

        Route::post('/add', [
            'as' => 'PermissionAdd',
            'uses' =>  $module_namespace . '\AjaxController@processPermission'
        ]);

        Route::get('/edit/{permission}', [
            'as' => 'PermissionEdit',
            'uses' =>  $module_namespace . '\PermissionController@edit'
        ])->where('permission', '[0-9]+');
    });
}); 




