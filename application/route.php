<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];

use think\Route;

//后台登陆
Route::any('login', 'admin/Public/login');
//后台登出
Route::get('logout', 'admin/Public/logout');
//后台首页
Route::get('/','admin/Index/index');

//后台分类管理
Route::group('admin',function(){
    //操作文章数据相关路由
    Route::any('article/add','admin/article/add'); //文章添加页
    Route::any('category/upd','admin/category/upd'); //文章编辑页
    Route::any('category/index','admin/category/index'); //文章列表页
    Route::get("article/getContent",'admin/article/getContent'); //查看文章内容的路由

    Route::any('category/add','admin/category/add');
    //Route::post('category/add','admin/category/add');
    Route::get('category/index','admin/category/index');
    Route::any('category/upd','admin/category/upd');
    //Route::post('category/upd','admin/category/upd');
    //文章分类删除
    Route::get('category/ajaxDel','admin/category/ajaxDel');

});
//测试路由
Route::get('test', 'index/Test/index');
Route::get('test1', 'index/Test/test');

//首页frame框架
Route::get('/top', 'admin/Index/top');
Route::get('/left', 'admin/Index/left');
Route::get('/main', 'admin/Index/main');

