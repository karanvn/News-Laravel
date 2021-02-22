<?php

Route::group(['middleware' => ['web', 'locale']], function () {

    $module_namespace = "App\Modules\Web\Controllers";

    Route::get('/', [
        'as' => 'home',
        'uses' =>  $module_namespace . '\HomeController@index'
    ]);
    Route::get('/searchBlog', [
        'as' => 'searchBlog',
        'uses' =>  $module_namespace . '\HomeController@searchBlog'
    ]);
    Route::POST('/searchBlog', [
        'as' => 'searchBlog',
        'uses' =>  $module_namespace . '\HomeController@searchBlog'
    ]);
    Route::get('/collections', [
        'as' => 'collections',
        'uses' =>  $module_namespace . '\HomeController@collections'
    ]);
    
    Route::post('/contact', [
        'as' => 'contact',
        'uses' =>  $module_namespace . '\HomeController@postContact'
    ]);

    route::post('/cart_combo',[
        'as'   => 'cart_combo',
        'uses' => $module_namespace . '\HomeController@cartCombo'
    ]);
    
    Route::post('/recive_info', [
        'as' => 'recive_info',
        'uses' =>  $module_namespace . '\HomeController@reciveInfoMail'
    ]);
    
    Route::get('/search', [
        'as' => 'search',
        'uses' =>  $module_namespace . '\HomeController@search'
    ]);

    Route::get('/ajaxDataHighlights/{id}', [
        'as' => 'ajaxDataHighlights',
        'uses' =>  $module_namespace . '\AjaxHomeController@ajaxDataHighlights'
    ]);
    Route::get('/loadProductsCollection/{id}', [
        'as' => 'loadProductsCollection',
        'uses' =>  $module_namespace . '\AjaxHomeController@loadProductsCollection'
    ]);
    Route::get('/loadCollectionsPage', [
        'as' => 'loadCollectionsPage',
        'uses' =>  $module_namespace . '\AjaxHomeController@loadCollectionsPage'
    ]);

    Route::post('/ajaxdanhmuc', [
        'as' => 'ajaxdanhmuc',
        'uses' =>  $module_namespace . '\AjaxHomeController@ajaxdanhmuc'
    ]);
  

    Route::get('/autocomplete-ajax/{name?}', [
        'as' => 'autocomplete_ajax',
        'uses' =>  $module_namespace . '\AjaxHomeController@autocomplete_ajax'
    ]);

    Route::get('/editLoveProduct/{id}', [
        'as'   => 'editLoveProduct',
        'uses' =>  $module_namespace . '\AjaxHomeController@editLoveProduct'
    ]);
     
    Route::get('/filterShort', [
        'as'   => 'filterShort',
        'uses' =>  $module_namespace . '\AjaxHomeController@filterShort'
    ]);

    Route::group(['prefix' => 'shop'], function() use($module_namespace){
        Route::post('checkprice', [
            'as' => 'checkprice',
            'uses' =>  $module_namespace . '\AjaxHomeController@checkprice'
        ]);
    });
    
    Route::get('/searchproductshow', [
        'as' => 'searchproductshow',
        'uses' =>  $module_namespace . '\AjaxHomeController@searchproductshow'
    ]);
       
    Route::get('/loadFeature/{id}/{feature?}', [
        'as' => 'nhapshow',
        'uses' =>  $module_namespace . '\AjaxHomeController@loadFeature'
    ]);
    
    Route::get('/ProductViewed/{id}', [
        'as' => 'ProductViewed',
        'uses' =>  $module_namespace . '\AjaxHomeController@ProductViewed'
    ]);
 
    Route::get('/showEvaluateProductDetail/{id}', [
        'as' => 'showEvaluateProductDetail',
        'uses' =>  $module_namespace . '\AjaxHomeController@showEvaluateProductDetail'
    ]);
   
    Route::get('/searchproductseacrchbutton', [
        'as' => 'searchproductseacrchbutton',
        'uses' =>  $module_namespace . '\AjaxHomeController@searchproductseacrchbutton'
    ]);
    
    Route::get('/pages/{slug}.html',[
        'as' => 'pages',
        'uses' =>  $module_namespace . '\HomeController@getPages'
    ]);
    
    Route::get('eva-{slug}.html',[
        'as' => 'pages-none',
        'uses' =>  $module_namespace . '\HomeController@getPagesNone'
    ]);
    
    Route::get('/danh-muc/{slug?}', [
        'as' => 'danhmuc',
        'uses' =>  $module_namespace . '\HomeController@danhmuc'
    ]);
    
    Route::POST('/commentblogNew', [
        'as' => 'commentblogNew',
        'uses' =>  $module_namespace . '\AjaxHomeController@commentblogNew'
    ]);

    

    Route::get('/amp/{alias1?}/{alias2?}/{alias3?}', [
        'as'   => 'optimize_slug',
        'uses' =>  $module_namespace . '\HomeController@handleURL'
    ]);

    Route::get('/{alias1?}/{alias2?}/{alias3?}', [
        'as'   => 'optimize_slug',
        'uses' =>  $module_namespace . '\HomeController@handleURL'
    ]);
    
    Route::get('/nhapshow/{slug}', [
        'as' => 'nhapshow',
        'uses' =>  $module_namespace . '\HomeController@nhapshow'
    ]);

    Route::get('/404.html',[
        'as'   => '404',
        'uses' => $module_namespace . '\HomeController@get404'
    ]);

    

    
    

});

   