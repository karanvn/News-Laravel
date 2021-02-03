<?php


$module_namespace = "App\Modules\Api\Controllers";
Route::group(['prefix' => 'api', 'middleware' => ['api']], function () use($module_namespace) {

    /*
    =======USER===================================================================================
    */

    Route::get('/users', [
        'as' => 'APIUsers',
        'uses' =>  $module_namespace . '\UserController@users'
    ]);

    Route::get('/user/{id}', [
        'as' => 'APIUser',
        'uses' =>  $module_namespace . '\UserController@user'
    ]);

    Route::post('/user', [
        'as' => 'APIAddUser',
        'uses' =>  $module_namespace . '\UserController@addUser'
    ]);

    Route::put('/user/{id}', [
        'as' => 'APIAddUser',
        'uses' =>  $module_namespace . '\UserController@addUser'
    ]);

    Route::post('/shipping', [
        'as' => 'APIAddShipping',
        'uses' =>  $module_namespace . '\UserController@addShipping'
    ]);

    Route::put('/shipping/{id}', [
        'as' => 'APIUpdateShipping',
        'uses' =>  $module_namespace . '\UserController@addShipping'
    ]);

    Route::get('/{id}/shippings', [
        'as' => 'APIUserShippings',
        'uses' =>  $module_namespace . '\UserController@shippings'
    ]);

    Route::get('/{id}/orders', [
        'as' => 'APIUserOrders',
        'uses' =>  $module_namespace . '\UserController@orders'
    ]);


    /*
    =======PRODUCT===================================================================================
    */

    Route::get('/products', [
        'as' => 'APIProducts',
        'uses' =>  $module_namespace . '\ProductController@products'
    ]);

    Route::get('/product/{id}', [
        'as' => 'APIProduct',
        'uses' =>  $module_namespace . '\ProductController@product'
    ]);

    Route::get('/categories', [
        'as' => 'APICategories',
        'uses' =>  $module_namespace . '\ProductController@categories'
    ]);

    /*
    =======BANNER===================================================================================
    */

    Route::get('/banners', [
        'as' => 'APIBanners',
        'uses' =>  $module_namespace . '\BannerController@banners'
    ]);

    /*
    =======ORDER===================================================================================
    */

    Route::post('/order', [
        'as' => 'APIAddOrder',
        'uses' =>  $module_namespace . '\UserController@addOrder'
    ]);

    /*
    =======LOCATION===================================================================================
    */

    Route::get('/states', [
        'as' => 'APIStates',
        'uses' =>  $module_namespace . '\LocationController@states'
    ]);

    Route::get('/{state_id}/districts', [
        'as' => 'APIDistricts',
        'uses' =>  $module_namespace . '\LocationController@districts'
    ]);

    Route::get('/{district_id}/wards', [
        'as' => 'APIWards',
        'uses' =>  $module_namespace . '\LocationController@wards'
    ]);

});

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth', 'can:view apis']], function () use ($module_namespace) {

    Route::group(['prefix' => 'third'], function () use($module_namespace) {

        Route::get('/user', [
            'as' => 'ThirdUser',
            'uses' =>  $module_namespace . '\ThirdController@user'
        ]);

        Route::post('/add_user', [
            'as' => 'ThirdAddUser',
            'uses' =>  $module_namespace . '\UserController@addUser'
        ]);

        Route::post('/update_user/{id}', [
            'as' => 'ThirdUpdateUser',
            'uses' =>  $module_namespace . '\UserController@addUser'

        ]);

        Route::post('/add_shipping', [
            'as' => 'ThirdAddShipping',
            'uses' =>  $module_namespace . '\UserController@addShipping'
        ]);

        Route::post('/update_shipping/{id}', [
            'as' => 'ThirdUpdateShipping',
            'uses' =>  $module_namespace . '\UserController@addShipping'
        ]);

        Route::get('/product', [
            'as' => 'ThirdPDS',
            'uses' =>  $module_namespace . '\ThirdController@product'
        ]);

        Route::get('/banner', [
            'as' => 'ThirdBNN',
            'uses' =>  $module_namespace . '\ThirdController@banner'
        ]);

        Route::get('/order', [
            'as' => 'ThirdORD',
            'uses' =>  $module_namespace . '\ThirdController@order'
        ]);

        Route::post('/add_order', [
            'as' => 'ThirdAddORD',
            'uses' =>  $module_namespace . '\UserController@addOrder'
        ]);

        Route::get('/location', [
            'as' => 'ThirdLocation',
            'uses' =>  $module_namespace . '\ThirdController@location'
        ]);

    });
});


