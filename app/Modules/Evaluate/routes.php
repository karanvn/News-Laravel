<?php
Route::group(['middleware' => ['web', 'locale','admin']], function () {
    $module_namespace = "App\Modules\Evaluate\Controllers";
    Route::group(['prefix' => 'evaluate'], function () use($module_namespace) {
         Route::get('/list/{page?}', [
            'as' => 'listvaluate',
            'uses' =>  $module_namespace . '\EvaluateController@list'
        ]);
        Route::get('/editevaluate/{id}', [
            'as' => 'editevaluate',
            'uses' =>  $module_namespace . '\EvaluateController@editevaluate'
        ]);
        Route::get('/editreviewproduct/{id}', [
            'as' => 'editreviewproduct',
            'uses' =>  $module_namespace . '\EvaluateController@editreviewproduct'
        ]);
        Route::post('/addRaitingAdmin', [
            'as' => 'addRaitingAdmin',
            'uses' =>  $module_namespace . '\AjaxEvaluateController@addRaitingAdmin'
        ]);
        
    });
});
Route::group(['middleware' => ['web', 'locale']], function () {
    $module_namespace = "App\Modules\Evaluate\Controllers";
    Route::group(['prefix' => 'evaluate'], function () use($module_namespace) {
        Route::post('/add', [
            'as' => 'addevaluate',
            'uses' =>  $module_namespace . '\AjaxEvaluateController@add'
        ]);
    });
});





