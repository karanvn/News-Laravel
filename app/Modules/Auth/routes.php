<?php

Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale']], function () {
    $module_namespace = "App\Modules\Auth\Controllers";

    Route::get('/login', [
        'as' => 'login',
        'uses' =>  $module_namespace . '\LoginController@login'
     ]);
    

     Route::post('/login', [
         'as' => 'login',
          'uses' =>  $module_namespace . '\AjaxController@login'
      ]);

      Route::get('/logout', [
         'as' => 'logout',
         'uses' =>  $module_namespace . '\LoginController@logout'
      ]);

      Route::get('/reset', [
        'as' => 'Reset',
        'uses' =>  $module_namespace . '\LoginController@reset'
     ]);
   

     Route::post('/reset', [
        'as' => 'Reset',
         'uses' =>  $module_namespace . '\AjaxController@reset'
     ]);
   
    

     Route::post('/resetPassword', [
        'as' => 'ResetPassword',
         'uses' =>  $module_namespace . '\AjaxController@resetPassword'
     ]);

      Route::group(['prefix' => 'user', 'middleware' => ['admin']], function () use($module_namespace) {
        Route::get('/list', [
            'as' => 'Admin',
            'uses' =>  $module_namespace . '\AdminController@index'
        ]);

        Route::get('/add', [
            'as' => 'AdminAdd',
            'uses' =>  $module_namespace . '\AdminController@add'
        ]);

        Route::post('/add', [
            'as' => 'AdminAdd',
            'uses' =>  $module_namespace . '\AjaxController@processAdmin'
        ]);

        Route::post('/rule', [
            'as' => 'AdminRule',
            'uses' =>  $module_namespace . '\AjaxController@processAdminRule'
        ]);

        Route::get('/edit/{user}/{page}', [
            'as' => 'AdminEdit',
            'uses' =>  $module_namespace . '\AdminController@edit'
        ]);

    });

    Route::group(['prefix' => 'customer', 'middleware' => ['admin']], function () use($module_namespace) {
       
        Route::get('/list', [
            'as' => 'Customer',
            'uses' =>  $module_namespace . '\CustomerController@index'
        ]);

        Route::get('/add', [
            'as' => 'CustomerAdd',
            'uses' =>  $module_namespace . '\CustomerController@add'
        ]);

        Route::get('/shipping/form/{change_id}', [
            'as' => 'CustomerAddShipping',
            'uses' =>  $module_namespace . '\AjaxController@processCustomerShippingForm'
        ]);

        Route::post('/add', [
            'as' => 'CustomerAdd',
            'uses' =>  $module_namespace . '\AjaxController@processCustomer'
        ]);

        Route::post('/add/shipping', [
            'as' => 'CustomerddShipping',
            'uses' =>  $module_namespace . '\AjaxController@processCustomerShipping'
        ]);

        Route::get('/edit/{user}/{page}', [
            'as' => 'CustomerEdit',
            'uses' =>  $module_namespace . '\CustomerController@edit'
        ]);

        Route::get('/order/{user}', [
            'as' => 'CustomerOrder',
            'uses' =>  $module_namespace . '\AjaxController@processCustomerOrder'
        ]);

        Route::get('/feedback', [
            'as' => 'CustomerFeedback',
            'uses' =>  $module_namespace . '\CustomerController@listFeedback'
        ]);
        
        Route::get('/register_info', [
            'as' => 'registerReciveInfo',
            'uses' =>  $module_namespace . '\CustomerController@registerReciveInfo'
        ]);
        
        Route::get('/sendmailBirthday', [
            'as' => 'sendmailBirthday',
            'uses' =>  $module_namespace . '\CustomerController@sendmailBirthday'
        ]);

    });

}); 
// người dùng
Route::group(['middleware' => ['web', 'locale']], function () {
    $module_namespace = "App\Modules\Auth\Controllers";
    Route::get('/addfeedBack', [
        'as' => 'addfeedBack',
         'uses' =>  $module_namespace . '\AjaxController@addfeedBack'
     ]);
    Route::get('/ResetCustomerGet', [
        'as' => 'ResetCustomerGet',
        'uses' =>  $module_namespace . '\LoginController@ResetCustomerGet'
     ]);
    Route::get('/resetCustomer', [
        'as' => 'resetCustomer',
        'uses' =>  $module_namespace . '\LoginController@resetCustomer'
     ]);
     
    Route::get('/register', [
        'as' => 'registermember',
        'uses' =>  $module_namespace . '\RegisterController@index'
    ]);
    Route::post('/register', [
        'as' => 'registermember',
        'uses' =>  $module_namespace . '\RegisterController@registerpost'
    ]);
    Route::get('/register', [
        'as' => 'registermember',
        'uses' =>  $module_namespace . '\RegisterController@index'
    ]);
     Route::get('/logoutmember', [
        'as' => 'logoutmember',
         'uses' =>  $module_namespace . '\LoginController@logoutmember'
    ]);
     Route::get('/login', [
        'as' => 'loginmember',
        'uses' =>  $module_namespace . '\LoginController@loginmember'
    ]);
     Route::post('/login', [
        'as' => 'loginmemberpost',
        'uses' =>  $module_namespace . '\LoginController@loginmemberpost'
    ]);
    //WEB Customer
    Route::group(['prefix' => 'user', 'middleware' => ['web', 'locale','customer']], function () {
        $module_namespace = "App\Modules\Auth\Controllers";
        //GET profile Customer
        Route::get('/profilePoint',[
            'as'    => 'profilePoint',
            'uses'  => $module_namespace . '\CustomerController@profilePoint'
        ]);
        Route::get('/profile', [
            'as'    => 'profile-customer',
            'uses'  =>  $module_namespace . '\CustomerController@getProfileCustomer'
        ]);
        //POST edit Customer
        Route::post('/edit-info',[
            'as'    => 'edit-info',
            'uses'  => $module_namespace . '\CustomerController@postEditInfoCustomer'
        ]);
        //GET edit password Customer
        Route::get('/change-password',[
            'as'    => 'change-password',
            'uses'  => $module_namespace . '\CustomerController@getEditPasswordCustomer'
        ]);
       
        //POST edit password Customer
        Route::post('/change-password',[
            'as'    => 'post-change-password',
            'uses'  => $module_namespace . '\CustomerController@postEditPasswordCustomer'
        ]);
        //GET order Customer
        Route::get('/orders',[
            'as'    => 'orders-customer',
            'uses'  => $module_namespace . '\CustomerController@getOrdersCustomer'
        ]);
        //GET order Customer
        Route::get('/orders/detail/{order_id}',[
            'as'    => 'order-detail',
            'uses'  => $module_namespace . '\CustomerController@getOrderDetailCustommer'
        ]);
        Route::get('/address',[
            'as'    => 'address-customer',
            'uses'  => $module_namespace . '\CustomerController@getAddressCustomer'
        ]);
        Route::get('/address/add',[
            'as'    => 'add-address-customer',
            'uses'  => $module_namespace . '\CustomerController@getAddAddressCustomer'
        ]);
        Route::post('/address/add',[
            'as'    => 'post-add-address-customer',
            'uses'  => $module_namespace . '\CustomerController@postAddAddressCustomer'
        ]);
        Route::get('/address/edit/{id}',[
            'as'    => 'edit-address-customer',
            'uses'  => $module_namespace . '\CustomerController@getEditAddressCustomer'
        ]);
        Route::post('/address/edit',[
            'as'    => 'post-edit-address-customer',
            'uses'  => $module_namespace . '\CustomerController@postEditAddressCustomer'
        ]);
        Route::get('/address/searchAddressAjax/{id?}',[
            'as'    => 'searchAddressAjax',
            'uses'  => $module_namespace . '\AjaxController@searchAddressAjax'
        ]);
        Route::get('/address/addAjax',[
            'as'    => 'addAddressAjax',
            'uses'  => $module_namespace . '\AjaxController@addAddressAjax'
        ]);
        Route::get('/district/{state_id}',[
            'as'    => 'district',
            'uses'  => $module_namespace . '\AjaxController@loadDistricts'
        ]);
        Route::get('/ward/{district_id}',[
            'as'    => 'ward',
            'uses'  => $module_namespace . '\AjaxController@loadWards'
        ]);
        Route::post('/cancel_order', [
            'as' => 'CustomerCancelOrder',
            'uses' =>  $module_namespace . '\CustomerController@cancelOrder'
        ]);
        
        Route::get('/withlist',[
            'as'    => 'withlist',
            'uses'  => $module_namespace . '\CustomerController@withlist'
        ]);
        Route::get('/withlistajax',[
            'as'    => 'withlistajax',
            'uses'  => $module_namespace . '\AjaxController@withlistajax'
        ]);
        Route::get('/deleteWithList/{id}/{i}',[
            'as'    => 'deleteWithList',
            'uses'  => $module_namespace . '\AjaxController@deleteWithList'
        ]);
    });
});



