<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
use think\Validate;
class CategoryController extends CommonController{
    public function ajaxDel(){
        //接收参数cat_id
        $cat_id = input('cat_id');
        //判断是否有子分类
        $where = [
            'pid' => $cat_id
        ];
        $result1 = Category::where($where)->find();
        if($result1){//说明有子分类
            $response = ['code'=>-1,'message'=>'分类下有子分类,无法删除'];
            return json($response);die;
        }
        //判断分类下面是否有文章
        $result2 = Article::where(['cat_id'=>$cat_id])->find();
        if($result2){//说明有文章
            $response = ['code'=>-2,'message'=>'分类下有文章,无法删除'];
            return json($response);die;
        }
        //只要上面两个条件都满足之后才可以删除分类
        if(Category::destroy($cat_id)){
            $response = ['code'=>200,'message'=>'删除成功'];
            return json($response);die;
        }else{
            $response = ['code'=>-3,'message'=>'删除失败'];
            return json($response);die;
        }


    }

    public function upd(){
        $catModel = new Category();
        //判断是否post方式请求
        if(request()->isPost()){
            //接收参数
            $postData = input('post.');
            //验证场景
            $result = $this->validate($postData,'category.upd',[],true);
            //判断是否验证成功
            if($result!==true){
                $this->error(implode(',', $result));
            }
            //判断是否更新成功
            if( $catModel->update($postData)){
                $this->success('修改成功',url('admin/category/index'));
            }else{
                $this->error('修改失败');
            }
        }
        $cat_id = input('cat_id');
        $catData = $catModel->find($cat_id);
        //添加无限极分类
        $data = $catModel->select();
        $cats = $catModel->getSonsCat($data);
        return $this->fetch('',[
            'cats' => $cats,
            'catData' => $catData
        ]);
    }

    public function index(){
        $catModel = new Category();
        $data = $catModel
            ->field('t1.*,t2.cat_name p_name')
            ->alias('t1')
            ->join('tp_category t2','t1.pid=t2.cat_id','left')
            ->select();
        //进行无限极分类处理
        $cats = $catModel->getSonsCat($data);
        //输出模板视图
        return $this->fetch('', ['cats'=>$cats]);
    }

    public function add(){
        $catModel = new Category();
        //判断是否post请求
        if(request()->isPost()){
            //接收post参数
            $postData = input('post.');
            //验证器验证规则
            $rule = [
                'cat_name' => 'require|unique:category',
                'pid' => "require"
            ];
            $message = [
                'cat_name.require' => '分类名称必填',
                'cat_name.unique' => '分类名称重复',
                'pid.require' => '必须选择一个分类'
            ];
            $validate = new Validate($rule,$message);
            $result = $validate->check($postData);
            //判断验证是否通过
            if(!$result){//没有通过
                $this->error($validate->getError());
            }
            //验证通过之后进行数据入库
            if($catModel->save($postData)){
                $this->success('入库成功',url('admin/category/index'));
            }else{
                $this->error('入库失败');
            }
        }

        //取出所有的分类
        $data = $catModel->select()->toArray();
        //对分类数据进行递归处理
        $cats = $catModel->getSonsCat($data);
        return $this->fetch('',['cats'=>$cats]);

    }
}