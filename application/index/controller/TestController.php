<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Model;
use app\index\model\Category;
use app\index\model\Article;
use app\admin\model\User;

class TestController extends Controller
{
    public function index()
{           $user = new User();
            $data = [
                'username'=>'admin',
                'password'=>md5('123456'.config('password_salt'))
            ];
            $user->save($data);
//        $cate= new Article();
//        $data = $cate->field('t1.*,t2.cat_name')
//            ->alias('t1')
//            ->join('tp_category t2','t1.cat_id = t2.cat_id','left')
//            ->select()
//            ->toArray();
//        dump($data);
//        $data = Db::name('category')
//            ->alias('t1')
//            ->field('t1.*,t2.cat_name as p_name')
//            ->join('tp_category t2','t1.pid = t2.cat_id','left')
//            ->select()
//            ->toArray();
//        dump($data);


    }

    public function test(){

        dump(input('id'));
        dump(input('username'));
    }
}
