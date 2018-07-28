<?php
namespace app\admin\model;
use think\Model;
class Category extends Model{
    protected  $pk = "cat_id";
    //protected  $createTime = "create_at";
    //时间戳自动维护
    protected $autoWriteTimestamp = true;

    public function getSonsCat($data,$pid=0,$level=1){
        static $result = []; //静态数组,后面递归调用的时候只会初始化一次
        foreach($data as $v){
            //第一次循环一定先找到pid=0的顶级
            if($v['pid'] == $pid){
                $v['level'] = $level; //加一层级关系
                $result[] = $v; //存放在$result中去
                //递归调用找子孙分类
                $this->getSonsCat($data,$v['cat_id'],$level+1);
            }
        }
        //返回递归处理好的数据
        return $result;
    }
}