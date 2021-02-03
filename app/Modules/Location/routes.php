<?php

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth', 'can:view admins']], function () {
    $module_namespace = "App\Modules\Location\Controllers";

    Route::group(['prefix' => 'location'], function () use ($module_namespace) {
        Route::get('/form', [
            'as' => 'LocationForm',
            'uses' =>  $module_namespace . '\AjaxController@processLocationForm'
        ]);
        Route::get('/excel', [
            'as' => 'frmExcelShipping',
            'uses' =>  $module_namespace . '\StateController@frmExcelShipping'
        ]);
        Route::post('/postExcelShip', [
            'as' => 'postExcelShip',
            'uses' =>  $module_namespace . '\AjaxController@postExcelShip'
        ]);
        Route::post('/postExcelShipCom', [
            'as' => 'postExcelShipCom',
            'uses' =>  $module_namespace . '\AjaxController@postExcelShipCom'
        ]);
        Route::get('/downloadDemoExcel/{type}', [
            'as' => 'downloadDemoExcel',
            'uses' =>  $module_namespace . '\AjaxController@downloadDemoExcel'
        ]);
    });

    Route::group(['prefix' => 'state'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'State',
            'uses' =>  $module_namespace . '\StateController@index'
        ]);

        Route::get('/add', [
            'as' => 'StateAdd',
            'uses' =>  $module_namespace . '\StateController@add'
        ]);

        Route::post('/add', [
            'as' => 'StateAdd',
            'uses' =>  $module_namespace . '\AjaxController@processState'
        ]);

        Route::get('/edit/{state}', [
            'as' => 'StateEdit',
            'uses' =>  $module_namespace . '\StateController@edit'
        ])->where('state', '[0-9]+');

        Route::get('/load', [
            'as' => 'StateLoad',
            'uses' =>  $module_namespace . '\AjaxController@loadStates'
        ]);
    });

    Route::group(['prefix' => 'district'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'District',
            'uses' =>  $module_namespace . '\DistrictController@index'
        ]);

        Route::get('/add', [
            'as' => 'DistrictAdd',
            'uses' =>  $module_namespace . '\DistrictController@add'
        ]);

        Route::post('/add', [
            'as' => 'DistrictAdd',
            'uses' =>  $module_namespace . '\AjaxController@processDistrict'
        ]);

        Route::get('/edit/{district}', [
            'as' => 'DistrictEdit',
            'uses' =>  $module_namespace . '\DistrictController@edit'
        ])->where('district', '[0-9]+');

        Route::get('/load/{state_id}', [
            'as' => 'DistrictLoad',
            'uses' =>  $module_namespace . '\AjaxController@loadDistricts'
        ])->where('state_id', '[0-9]+');
    });

    Route::group(['prefix' => 'ward'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'Ward',
            'uses' =>  $module_namespace . '\WardController@index'
        ]);

        Route::get('/add', [
            'as' => 'WardAdd',
            'uses' =>  $module_namespace . '\WardController@add'
        ]);

        Route::post('/add', [
            'as' => 'WardAdd',
            'uses' =>  $module_namespace . '\AjaxController@processWard'
        ]);

        Route::get('/edit/{ward}', [
            'as' => 'WardEdit',
            'uses' =>  $module_namespace . '\WardController@edit'
        ])->where('ward', '[0-9]+');

        Route::get('/load/{district_id}', [
            'as' => 'WardLoad',
            'uses' =>  $module_namespace . '\AjaxController@loadWards'
        ])->where('district_id', '[0-9]+');
    });
});

Route::group([ 'middleware' => ['web', 'locale']], function () {
    $module_namespace = "App\Modules\Location\Controllers";
    Route::get('/district/load/{state_id}', [
        'as' => 'DistrictLoadall',
        'uses' =>  $module_namespace . '\AjaxController@loadDistricts'
    ])->where('state_id', '[0-9]+');
    
    Route::get('/district/loadFilter/{state_id}', [
        'as' => 'DistrictloadFilter',
        'uses' =>  $module_namespace . '\AjaxController@DistrictloadFilter'
    ])->where('state_id', '[0-9]+');

    Route::get('/ward/load/{district_id}', [
        'as' => 'WardLoadall',
        'uses' =>  $module_namespace . '\AjaxController@loadWards'
    ])->where('district_id', '[0-9]+');

    Route::get('/ward/loadFilter/{state_id}', [
        'as' => 'wardloadFilter',
        'uses' =>  $module_namespace . '\AjaxController@wardloadFilter'
    ])->where('state_id', '[0-9]+');

    Route::get('/states/loadFilter', [
        'as' => 'statesloadFilter',
        'uses' =>  $module_namespace . '\AjaxController@statesloadFilter'
    ]);



    Route::get('/shipPing/{ward}', [
        'as' => 'shipPing',
        'uses' =>  $module_namespace . '\AjaxController@shipPing'
    ]);
});




