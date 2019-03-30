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

Route::get('/', function () {
//    echo __FILE__;echo '</br>';
//    echo date('Y-m-d H:i:s');
    //echo '<pre>';print_r($_SESSION);echo '</pre>';
    //echo '<pre>';print_r($_COOKIE);echo '</pre>';
    return view('welcome');
});

Route::group([
    'prefix'    => '/admin/',
],function(){
    return 'aaa';
});

Route::get('/admin*',function(){
    return '403';
});

//Route::get('/','Home\IndexController@index');

Route::get('/info',function(){
    phpinfo();
});

Route::get('/adduser','User\UserController@add');

//路由跳转
Route::redirect('/hello1','/world1',301);
Route::get('/world','Test\TestController@world1');

Route::get('hello2','Test\TestController@hello2');
Route::get('world2','Test\TestController@world2');


//路由参数
Route::get('/user/test','User\UserController@test');
//Route::get('/user/{uid}','User\UserController@user');
Route::get('/month/{m}/date/{d}','Test\TestController@md');
Route::get('/name/{str?}','Test\TestController@showName');



// View视图路由
Route::view('/mvc','mvc');
Route::view('/error','error',['code'=>40300]);


// Query Builder
Route::get('/query/get','Test\TestController@query1');
Route::get('/query/where','Test\TestController@query2');


//Route::match(['get','post'],'/test/abc','Test\TestController@abc');
Route::any('/test/abc','Test\TestController@abc');


Route::get('/view/test1','Test\TestController@viewTest1');
Route::get('/view/test2','Test\TestController@viewTest2');




//用户注册
Route::get('/user/reg','User\UserController@reg');
Route::post('/user/reg','User\UserController@doReg');

Route::get('/user/login','User\UserController@login');           //用户登录
Route::post('/user/login','User\UserController@doLogin');        //用户登录
Route::get('/user/center','User\UserController@center')->middleware('check.login.token');        //个人中心


//模板引入静态文件
Route::get('/mvc/test1','Mvc\MvcController@test1');

Route::get('/mvc/bst','Mvc\MvcController@bst');


//Test
//Route::any('/test/guzzle','Test\TestController@guzzleTest');
//Route::get('/test/cookie1','Test\TestController@cookieTest1');
//Route::get('/test/cookie2','Test\TestController@cookieTest2');
//Route::get('/test/session','Test\TestController@sessionTest');
//Route::get('/test/mid1','Test\TestController@mid1')->middleware('check.uid');        //中间件测试
//Route::get('/test/check_cookie','Test\TestController@checkCookie')->middleware('check.cookie');        //中间件测试

Route::middleware(['log.click'])->group(function(){
    Route::any('/test/guzzle','Test\TestController@guzzleTest');
    Route::get('/test/cookie1','Test\TestController@cookieTest1');
    Route::get('/test/cookie2','Test\TestController@cookieTest2');
    Route::get('/test/session','Test\TestController@sessionTest');
    Route::get('/test/mid1','Test\TestController@mid1')->middleware('check.uid');        //中间件测试
    Route::get('/test/check_cookie','Test\TestController@checkCookie')->middleware('check.cookie');

    Route::get('/test/url1','Test\TestController@url1');
});

Route::get('/test/end','Test\TestController@mid3')->middleware('res.end');



//购物车
//Route::get('/cart','Cart\IndexController@index')->middleware('check.uid');
Route::get('/cart','Cart\IndexController@index');
Route::get('/cart/add/{goods_id}','Cart\IndexController@add')->middleware('check.login.token');      //添加商品
Route::post('/cart/add2','Cart\IndexController@add2')->middleware('check.login.token');      //添加商品
Route::get('/cart/del/{goods_id}','Cart\IndexController@del')->middleware('check.login.token');      //删除商品
Route::get('/cart/del2/{goods_id}','Cart\IndexController@del2')->middleware('check.login.token');      //删除商品


//商品
Route::get('/goods/detail/{goods_id}','Goods\IndexController@index');          //商品详情
Route::get('/goods/list','Goods\IndexController@goodsList');          //商品列表


//订单
Route::get('/order/list','Order\IndexController@orderList');           //订单列表
Route::get('/order/add','Order\IndexController@add');           //下单


//支付
Route::get('/pay/alipay/test','Pay\AlipayController@test');         //测试
Route::get('/pay/o/{oid}','Pay\AlipayController@pay')->middleware('check.login.token');         //订单支付
Route::post('/pay/alipay/notify','Pay\AlipayController@aliNotify');        //支付宝支付 异步通知回调
Route::get('/pay/alipay/return','Pay\AlipayController@aliReturn');        //支付宝支付 同步通知回调


Route::get('/crontab/delete_orders','Crontabs\IndexController@deleteOrders');        //删除过期订单

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/upload','Goods\IndexController@uploadIndex');
Route::post('/goods/upload/pdf','Goods\IndexController@uploadPDF');



//在线订座
Route::get('/movie/seat','Movie\IndexController@index');


//微信
Route::get('/weixin/refresh_token','Weixin\WeixinController@refreshToken');     //刷新token
Route::get('/weixin/test/token','Weixin\WeixinController@test');
//Route::get('/weixin/valid','Weixin\WeixinController@validToken');
//Route::get('/weixin/valid1','Weixin\WeixinController@validToken1');
Route::post('/weixin/valid1','Weixin\WeixinController@wxEvent');//接收微信服务器事件推送
Route::get('/weixin/valid1','Weixin\WeixinController@senwx');
Route::post('/weixin/valid','Weixin\WeixinController@validToken');
Route::get('/weixin/create_menu','Weixin\WeixinController@createMenu');     //创建菜单


Route::get('/form/show','Weixin\WeixinController@formShow');     //表单测试
Route::post('/form/test','Weixin\WeixinController@formTest');     //表单测试




Route::get('/test/405','Weixin\WeixinController@http405');     //获取永久素材列表


Route::get('/weixin/material/list','Weixin\WeixinController@materialList');     //获取永久素材列表
Route::get('/weixin/material/upload','Weixin\WeixinController@upMaterial');     //上传永久素材
Route::post('/weixin/material','Weixin\WeixinController@materialTest');     //创建菜单

//微信聊天
Route::get('/weixin/kefu/chat','Weixin\WeixinController@chatView');     //客服聊天
Route::get('/weixin/chat/get_msg','Weixin\WeixinController@getChatMsg');     //获取用户聊天信息



//微信支付
Route::get('/weixin/pay/test','Weixin\PayController@test');     //微信支付测试
Route::post('/weixin/pay/notice','Weixin\PayController@notice');     //微信支付通知回调


//微信JS SDK
Route::get('/weixin/jssdk/test','Weixin\WeixinController@jssdkTest');//测试




Route::resource('/res',Api\ResController::class);
//注册
Route::get('/zhuce','Passpt\PassController@zhuce');
Route::post('/zhuce/ruku','Passpt\PassController@ruku');

//登录页面
Route::post('/loginl','Passpt\PassController@loginl');


//test
//web端登录
Route::get('/login/weblogin','Passpt\PassController@weblogin');
//app端登录
Route::get('/login/applogin','Passpt\PassController@applogin');
