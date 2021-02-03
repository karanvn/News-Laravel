<?php
//admin
Route::group(['prefix' => config('cus.route.admin'), 'middleware' => ['web', 'locale', 'auth']], function () {
    $module_namespace = "App\Modules\Blog\Controllers";
    //Blog Category
    Route::group(['prefix' => 'blog/category'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'blog-category-list',
            'uses' =>  $module_namespace . '\BlogCategoryController@list'
        ]);
        Route::get('/add',[
            'as' => 'blog-category-add',
            'uses' => $module_namespace . '\BlogCategoryController@getAdd'
        ]);
        Route::post('/add',[
            'as' => 'blog-category-add-post',
            'uses' => $module_namespace . '\BlogCategoryController@postAdd'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'blog-category-edit',
            'uses' => $module_namespace . '\BlogCategoryController@getEdit'
        ]);
        Route::post('/edit',[
            'as' => 'blog-category-edit-post',
            'uses' => $module_namespace . '\BlogCategoryController@postEdit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'blog-category-delete',
            'uses' => $module_namespace . '\BlogCategoryController@getDelete'
        ]);
        Route::get('/banner/{banner}', [
            'as' => 'ProductCategoryBanner',
            'uses' =>  $module_namespace . '\BlogCategoryController@processBanner'
        ]);

    });
    //Blog
    Route::group(['prefix' => 'blog'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'blog-list',
            'uses' =>  $module_namespace . '\BlogController@list'
        ]);
        Route::get('/categoryselected/{category}', [
            'as' => 'categoryselected',
            'uses' =>  $module_namespace . '\BlogCategoryController@categoryselected'
        ]);
        
        Route::get('/seachAddCategory/{name?}', [
            'as' => 'seachAddCategory',
            'uses' =>  $module_namespace . '\BlogController@seachAddCategory'
        ]);
        Route::get('/add',[
            'as' => 'blog-add',
            'uses' => $module_namespace . '\BlogController@getAdd'
        ]);
        Route::post('/add',[
            'as' => 'blog-add-post',
            'uses' => $module_namespace . '\BlogController@postAdd'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'blog-edit',
            'uses' => $module_namespace . '\BlogController@getEdit'
        ]);
        Route::post('/edit',[
            'as' => 'blog-edit-post',
            'uses' => $module_namespace . '\BlogController@postEdit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'blog-delete',
            'uses' => $module_namespace . '\BlogController@getDelete'
        ]);
        Route::get('/treeblog/{id}',[
            'as' => 'treeblog',
            'uses' => $module_namespace . '\BlogController@treeblog'
        ]);
    });
    //Blog Comment
    Route::group(['prefix' => 'comment'], function () use ($module_namespace) {
        Route::get('/list/{blog_id}', [
            'as' => 'comment-list',
            'uses' =>  $module_namespace . '\BlogCommentController@list'
        ]);
          Route::get('/lists', [
            'as' => 'listsCommentBlog',
            'uses' =>  $module_namespace . '\BlogCommentController@lists'
        ]);
        Route::get('/detail/{id}', [
            'as' => 'comment-detail',
            'uses' =>  $module_namespace . '\BlogCommentController@detail'
        ]);
        Route::post('/add',[
            'as' => 'comment-add-post',
            'uses' => $module_namespace . '\BlogCommentController@postAdd'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'comment-delete',
            'uses' => $module_namespace . '\BlogCommentController@getDelete'
        ]);
        Route::get('/status/{id}',[
            'as'    =>'status',
            'uses' => $module_namespace . '\BlogCommentController@getStatus'
        ]);

         Route::get('/editStatusCommentBlog/{id}', [
            'as' => 'editStatusCommentBlog',
            'uses' =>  $module_namespace . '\BlogCommentController@editStatusCommentBlog'
        ]);

        Route::get('/deleteStatusCommentBlog/{id}', [
            'as' => 'deleteStatusCommentBlog',
            'uses' =>  $module_namespace . '\BlogCommentController@deleteStatusCommentBlog'
        ]);
        Route::post('/addCommentBlog', [
            'as' => 'addCommentBlog',
            'uses' =>  $module_namespace . '\BlogCommentController@addCommentBlog'
        ]);
        
    });
    //page tĩnh
    Route::group(['prefix' => 'static-page'], function () use ($module_namespace) {
        Route::get('/list', [
            'as' => 'static-page',
            'uses' =>  $module_namespace . '\BlogController@getStaticPage'
        ]);
        Route::get('/add',[
            'as' => 'static-page-add',
            'uses' => $module_namespace . '\BlogController@getAddStaticPage'
        ]);
        Route::post('/add',[
            'as' => 'static-page-add-post',
            'uses' => $module_namespace . '\BlogController@postAddStaticPage'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'static-page-edit',
            'uses' => $module_namespace . '\BlogController@getEditStaticPage'
        ]);
        Route::post('/edit',[
            'as' => 'static-page-edit-post',
            'uses' => $module_namespace . '\BlogController@postEditStaticPage'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'static-page-delete',
            'uses' => $module_namespace . '\BlogController@getDelete'
        ]);
    });
});
// người dùng
Route::group(['middleware' => ['web', 'locale']], function () {
    $module_namespace = "App\Modules\Blog\Controllers";
    //comment
    Route::post('/comment',[
        'as'    => 'comment',
        'uses' => $module_namespace . '\BlogCommentController@postComment'
    ]);
});


