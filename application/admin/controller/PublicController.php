<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
use think\Validate;
class PublicController extends Controller{

	public function login(){
		//判断是否post请求
        if( request()->isPost() ){
            $postData = input('post.');
            //验证数据是否合法
            //1.验证规则
            $rule = [
                //表单name名称 => 验证规则（多个用属性隔开）
                'username' => "require|length:4,8",
                'password' => "require",
                'captcha'  => 'require|captcha'
            ];
            //2.验证失败提示信息
            $message = [
                //表单name名称.规则名 => '相应提示错误信息'
                'username.require' => '用户名必填',
                'username.length' => '用户名长度在4-8之前',
                'password.require' => '密码必填',
                'captcha.require' => '验证码必填',
                'captcha.captcha' => '验证码错误'
            ];
            //3.实例化验证对象
            $validate = new Validate($rule,$message);
            $res = $validate->check($postData);
            //4.判断验证是否成功
            if(!$res){//验证失败
                $this->error($validate->getError() );
            }
            $userModel = new User;
            $flag = $userModel->checkUser($postData['username'],$postData['password']);
            if($flag){
                //直接重定向到后台首页
                $this->redirect('/');
            }else{
                $this->error('用户名或密码错误');
            }
        }
		return $this->fetch();
	}


	public function logout(){
        session(null);
        $this->redirect('/login');
	}
}

