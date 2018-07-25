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

//后台首页
Route::get('/','admin/Index/index');
//后台登陆页
Route::get('admin/login', 'admin/Index/login');
//后台登出
Route::get('logout', 'admin/Index/logout');
//测试路由
Route::get('/test', 'index/Test/index');
Route::get('/test1', 'index/Test/test');

//首页frame框架
Route::get('/top', 'admin/Index/top');
Route::get('/left', 'admin/Index/left');
Route::get('/main', 'admin/Index/main');

