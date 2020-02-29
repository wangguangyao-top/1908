<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     $name='1908 你好';
//     return view('welcome',['name'=>$name]);    
// });
Route::get('/','index\indexController@index');
// Route::get('/index', 'UserController@index');
/**
 * 登录
 */
Route::get('/login', 'index\indexController@login');
Route::post('/login2', 'index\indexController@login2');
/**
 * 注册
 */
Route::get('/reg', 'index\indexController@reg');
/**
 * cookie测试
 */
Route::get('/addcookie', 'index\IndexController@addcookie');
/**
 * 手机验证码
 */
Route::get('/sendsms', 'index\IndexController@sendsms');
Route::post('/show', 'index\IndexController@show');
Route::post('/sess', 'index\IndexController@sess');
/**
 * 邮箱验证
 */
Route::get('/setemail', 'index\IndexController@senEmail');
/**
 * 注册
 */
Route::post('/add', 'index\IndexController@add');
/**
 * 详情
 */
Route::get('/proinfo/{id}', 'index\ProInfo@proinfo');
/**
 * 加入购物车
 */
Route::post('/add_details', 'index\ProInfo@add_details');
/**
 * 购物车列表展示
 */
Route::get('/index/car', 'index\car@index');
// Route::get('/adddo', 'UserController@add');
// Route::post('/addd', 'UserController@addd')->name('do');
/**
 * 练习1
 */
Route::get('/ajj/{id}/{name}',function($id,$name){
    echo '商品id：';
    echo $id;
    echo '商品名称';
    echo $name;
})->where(['name'=>'[a-zA-Z]+']);
//1
Route::prefix('people')->middleware('checktoken')->group(function(){
//添加页面1
    Route::get('/create','peopleController@create');
//执行添加1
    Route::post('/store', 'peopleController@store');
//展示1
    Route::get('/index','peopleController@index');
//修改展示1
    Route::get('/edit7/{id}','peopleController@edit');
//修改成功跳转1
    Route::post('/update5/{id}', 'peopleController@update');
//删除1
    Route::get('/destroy2/{id}', 'peopleController@destroy');
});

//2
Route::prefix('shop')->group(function(){
//练习列表展示1
    Route::get('/create','shopController@create');
//练习添加1
    Route::post('/store','shopController@store');
//练习展示1
    Route::get('/index','shopController@index');
//修改页面
    Route::get('/edit/{id}','shopController@edit');
//修改成功
    Route::post('/update/{id}','shopController@update');
//删除
    Route::get('/destroy8/{id}','shopController@destroy');
});
//3
//添加页面
Route::prefix('students')->group(function(){
    Route::get('/create','studentsController@create');
    Route::post('/store','studentsController@store');
    Route::get('/index','studentsController@index');
    Route::get('/edit/{id}','studentsController@edit');
    Route::post('/update/{id}','studentsController@update');
    Route::get('/destroy/{id}','studentsController@destroy');
});
Route::view('admin/login', 'login');
Route::post('admin/logindo','logindoController@login');

Route::prefix('wenzang')->middleware('checktoken1')->group(function(){
    Route::get('/create','essayController@create');  
    Route::post('/sole','essayController@sole');
    Route::post('/store','essayController@store');
    Route::get('/index','essayController@index');
    Route::get('/edit/{id}','essayController@edit');
    Route::post('/shop_sole','essayController@shop_sole');
    Route::post('/update/{id}','essayController@update');
    Route::post('/destroy','essayController@destroy');
    Route::get('/index2','essayController@index2');
});

Route::prefix('goods')->group(function(){
    Route::get('/create','goodsController@create');
    Route::post('/goods_sole','goodsController@goods_sole');
    Route::post('/store','goodsController@store');
    Route::get('/index','goodsController@index');
    Route::get('/edit/{id}','goodsController@edit');
    Route::post('/update/{id}','goodsController@update');
    Route::post('/destroy/{id}','goodsController@destroy');
});

Route::prefix('goodsdo')->group(function(){
    Route::get('/create','goods@create');
    Route::post('/store','goods@store');
    Route::get('/index','goods@index');
    Route::get('/edit/{id}','goods@edit');
    Route::post('/update/{id}','goods@update');
    Route::get('/destroy/{id}','goods@destroy');    
});

// Route::prefix('login')->group(function(){
//     Route::get('/create','login@create');
//     Route::post('/sole','login@sole');
//     Route::post('/user_sole/{id}','login@user_sole');
//     Route::post('/store','login@store');
//     Route::get('/index','login@index');
//     Route::get('/edit/{id}','login@edit');
//     Route::post('/update/{id}','login@update');
//     Route::get('/destroy/{id}','login@destroy');
// });

/**
 * 秘钥
 */
// LTAI4FxuPPnJF3fhUi3K2tiJ

// AccessKeySecret:

// 1kcjwvhdmbaDEKRTVJiKJW6alkYHeC
//邮箱秘钥
//tacjqsjpxsjvddff
/**
 * 货物管理
 */
Route::prefix('userinfo2')->group(function(){
    Route::get('/create','UserInfo@create');
    Route::post('/store','UserInfo@store');
    Route::get('/show','UserInfo@show');
    Route::get('/index','UserInfo@index');
    Route::get('/add','UserInfo@add');
    Route::post('/add2','UserInfo@add2');
    Route::get('/destroy/{id}','UserInfo@destroy');
});


