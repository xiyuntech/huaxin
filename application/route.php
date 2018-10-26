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



//培训列表
Route::get('api/:version/trains/get','api/:version.Train/getTrains');
//培训详情
Route::get('api/:version/train/get','api/:version.Train/getTrainDetail');