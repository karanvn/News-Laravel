<?php

$prefixAdmin = config('cus.route.admin');

route::group(['prefix' => $prefixAdmin, 'middleware' => ['web', 'locale','auth']], function(){

    $module_namespace   = "App\Modules\Schema\Controllers";
    $controllerName     = 'schema';
    $controllerNameAjax = 'ajaxSchema';
    
    route::group(['prefix'=>'schema'], function() use($module_namespace, $controllerName, $controllerNameAjax){
        
        $controller     = ucfirst($controllerName)  . 'Controller@';
        $controllerAjax = ucfirst($controllerNameAjax)  . 'Controller@';

        Route::get('/list', [
            'as' => 'Schema',
            'uses' => $module_namespace . '\\' .$controller. 'index'
        ]);
        
        Route::get('/add', [
            'as'   => 'SchemaAdd',
            'uses' => $module_namespace . '\\' .$controller. 'add'
            ]);

        Route::post('/add', [
            'as'   => 'SchemaAdd',
            'uses' => $module_namespace . '\\' .$controller. 'postadd'
        ]);

    });
});






