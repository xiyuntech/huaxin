<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


use think\Route;


//登录
Route::post('api/:version/token/user','api/:version.Token/get');

//获取轮播图
Route::get('api/:version/banners/get','api/:version.Banner/getBanners');


//关于我们
Route::get('api/:version/about/us','api/:version.Company/getAboutUs');

//获取工程案例列表
Route::get('api/:version/examples/get','api/:version.Example/getExamples');

//获取咨询列表
Route::get('api/:version/articles/get','api/:version.Article/getArticles');
//咨询详情
Route::get('api/:version/article/get','api/:version.Article/getArticleDetail');


//检测分类列表
Route::get('api/:version/categories/get','api/:version.Category/getCategories');
//检测分类详情
Route::get('api/:version/category/get','api/:version.Category/getCategory');
//获取分类下的产品
Route::get('api/:version/products/get','api/:version.Product/getProducts');




//培训列表
Route::get('api/:version/trains/get','api/:version.Train/getTrains');
//培训详情
Route::get('api/:version/train/get','api/:version.Train/getTrainDetail');



//新增委托单位
Route::post('api/:version/unit/add','api/:version.User/addUnit');
//修改委托单位
Route::post('api/:version/unit/edit','api/:version.User/updateUnit');
//删除委托单位
Route::post('api/:version/unit/delete','api/:version.User/deleteUnit');
//选中委托单位
Route::post('api/:version/unit/check','api/:version.User/checkUnit');
//委托单位列表
Route::get('api/:version/units/get','api/:version.User/getUnits');


//发票设置
Route::get('api/:version/invoice/setting','api/:version.User/createOrUpdateInvoice');
Route::post('api/:version/invoice/setting','api/:version.User/createOrUpdateInvoice');

//培训报名
Route::post('api/:version/train/enroll','api/:version.User/enrollTrain');
//我的培训
Route::get('api/:version/trains/get','api/:version.User/getTrains');
//下单
Route::post('api/:version/order/place','api/:version.Order/placeOrder');
//我的订单
Route::get('api/:version/orders/get','api/:version.Order/getOrders');