<?php
namespace app\index\controller;
use think\Controller;

class TestController extends Controller
{
    public function index()
    {	
    	$name = '胡歌';
    	$age = 32;
    	$users = [
    		['username' => '啊宝', 'age' => 23],
    		['username' => '老胡', 'age' => 33],
    		['username' => '大苏', 'age' => 26],
    	];
    	$this->assign([
    			'name' => $name,
    			'age' => $age,
    		]);
        return $this->fetch('index',[
        		'users' => $users
        	]);
    }

    public function test(){

    	// $this->success('跳转成功',url('/'));
    	$this->error('跳转失败,返回上一级');
    }
}
