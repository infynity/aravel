<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//管理员登陆
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 管理员注册
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//重置密码

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/home', 'Auth\AuthController@getLogout');
//上传
Route::post('upload', 'UploadController@store');

//微信接口
Route::group(['namespace' => 'Wechat'], function () {
    Route::any('/wechat/api', 'ApiController@serve');
    Route::get('/', 'IndexController@index');

    //分类
    Route::get('category', 'IndexController@category');
    Route::get('category/{category_id}', 'IndexController@good_list');
    Route::get('good/{good_id}', 'IndexController@good');

    //购物车
    Route::get('cart', 'IndexController@cart');
    Route::post('cart', 'IndexController@add_cart');
    Route::post('/cart/del', 'IndexController@del');

    //账户
    Route::get('account', 'IndexController@account');
    Route::get('address/{user_id}', 'IndexController@address');
    Route::put('address/update/{address_id}', 'IndexController@addr_up');
    Route::post('address', 'IndexController@add_addr');
    Route::get('user_info/{user_id}','IndexController@user_info');

    //下订单，物流，支付
    Route::get('setorder','IndexController@setorder');
    Route::get('getorder','IndexController@getorder');
    Route::get('oneorder/{order_id}', 'IndexController@oneorder');
    Route::get('pay/{order_id}', 'IndexController@pay');
    Route::get('send/{order_id}', 'IndexController@send');
    Route::get('comment/{order_id}', 'IndexController@getbag');
    Route::post('/comment', 'IndexController@comment');
    Route::get('/getmycom/{order_id}', 'IndexController@getmycom');
    Route::get('/wpay', 'IndexController@waitpayorder');
});

//后台  , 'middleware' => 'auth'
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' =>  ['csrf', 'auth']], function () {
    Route::get('/', 'IndexController@index');

    //商品品牌，除去show方法
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/search', 'BrandController@search');
        Route::patch('/sort', 'BrandController@sort');
    });

    Route::resource('brand', 'BrandController', ['except' => ['show']]);

    //商品类型
    Route::resource('type', 'TypeController', ['except' => ['show']]);

    //商品属性，需要加入商品类型的id
    Route::group(['prefix' => 'type/{type_id}'], function () {
        Route:
        delete('del_all', [
            'as' => 'admin.type.{type_id}.attribute.del_all', 'uses' => 'AttributeController@del_all'
        ]);
        Route::resource('attribute', 'AttributeController', ['except' => ['show']]);
    });

    //栏目管理
    Route::resource('category', 'CategoryController', ['except' => ['show']]);


    //商品管理
    Route::group(['prefix' => 'good'], function () {
        Route::get('/trash', 'GoodController@trash');
        Route::get('/{good}/restore', [
            'as' => 'admin.good.restore', 'uses' => 'GoodController@restore'
        ]);
        Route::delete('/{good}/force_destroy', [
            'as' => 'admin.good.force_destroy', 'uses' => 'GoodController@force_destroy'
        ]);
        Route::get('/search',[
            'as' => 'admin.good.search', 'uses' => 'GoodController@search'
        ]);
    });
    Route::resource('good', 'GoodController');

    //评论
    Route::patch('/comment/{comment}/reply', [
        'as' => 'admin.comment.reply', 'uses' => 'CommentController@reply'
    ]);

    Route::resource('comment', 'CommentController');

    //会员管理
    Route::resource('user', 'UserController');

    //订单管理
    Route::resource('order', 'OrderController');
    //微信管理
    Route::group(['prefix' => 'wechat'], function () {
        Route::get('get_menu', ['uses' => 'WechatController@get_menu']);
        Route::put('set_menu', ['uses' => 'WechatController@set_menu']);
        Route::get('api_config', ['uses' => 'WechatController@api_config']);
        Route::put('set_config', ['uses' => 'WechatController@set_config']);
    });
});



