<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
use think\Validate;

class ArticleController extends CommonController{
    public function index(){

    }

    public function add(){
        //获取无限极分类
        $catModel = new Category();
        $artModel = new Article();
        //1.判断是否post请求
        if(request()->isPost()){
            //2.接收参数
            $postData = input('post.');
            //3.单独验证器验证一下
            $result = $this->validate($postData,'Article.add',[],true);
            if($result!==true){
                $this->error(implode(',',$result));
            }
            //判断是否有文件上传
            if($file = request()->file('img')){
                //定义上传文件的目录
                $uploadDir = "./upload/";
                //定义文件上传的验证规则
                $condition = [
                    'size' => 1024*1024*2,
                    'ext' => 'png,jpg,gif,jpeg'
                ];
                //上传验证并进行上传文件
                $info = $file->validate($condition)->move($uploadDir);
                //判断是否上传成功
                if($info){
                    //成功,获取上传的目录文件信息,存储到数据库
                    $postData['ori_img'] = $info->getSaveName();
                }else{
                    //上传失败,提示上传错误信息
                    $this->error($file->getError());
                }

            }

            //4.判断是否入库成功
            if($artModel->save($postData)){
                $this->success('入库成功',url('admin/article/index'));
            }else{
                $this->error('入库失败');
            }
        }


        $cats = $catModel->getSonsCat( $catModel->select() );
        //分配变量到模板
        return $this->fetch('',['cats'=>$cats]);
    }
}