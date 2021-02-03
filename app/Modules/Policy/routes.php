

<?php


// $prefixAdmin = config('cus.route.admin');

// route::group(['prefix' => $prefixAdmin, 'middleware' => ['web', 'locale','auth']], function(){

//     $module_namespace   = 'App\Modules\Policy\Controllers';
//     $controllerName     = 'policy';
//     $controllerNameAjax = 'ajaxPolicy';
//     // dd($controllerNameAjax);
    
//     route::group(['prefix'=>'policy'], function() use($module_namespace, $controllerName, $controllerNameAjax){
        
//         $controller     = ucfirst($controllerName)  . 'Controller@';
//         $controllerAjax = ucfirst($controllerNameAjax)  . 'Controller@';
        
//         $module_namespace = "App\Modules\Policy\Controllers";

//         Route::get('/list', [
//             'as'   => 'listPolicy',
//             'uses' =>  $module_namespace .  '\\' . $controller .'index'
//         ]);
//         route::get('add',[
//             'as'   => 'addPolicy',
//             'uses' => $module_namespace .  '\\' . $controller .'add'
//         ]);
//         Route::post('/add', [
//             'as'   => 'addPolicy',
//             $module_namespace .  '\\' . $controller .'postadd'
//         ]);

//     });
// });


Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth']], function () {
    $module_namespace = "App\Modules\Policy\Controllers";
    Route::group(['prefix' => 'policy'], function () use($module_namespace) {
        Route::get('/list', [
            'as' => 'Policy',
            'uses' =>  $module_namespace . '\PolicyController@index'
        ]);

        Route::get('/add', [
            'as' => 'PolicyAdd',
            'uses' =>  $module_namespace . '\PolicyController@add'
        ]);

        Route::post('/add', [
            'as' => 'PolicyAdd',
            'uses' =>  $module_namespace . '\AjaxController@processPolicy'
        ]);

        Route::get('/edit/{policy}', [
            'as' => 'PolicyEdit',
            'uses' =>  $module_namespace . '\PolicyController@edit'
        ])->where('policy', '[0-9]+');

    });
}); 





