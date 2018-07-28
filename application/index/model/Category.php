<?php
namespace app\index\model;
use think\Model;
class Category extends Model{
    //指定当前模型表的主键字段
    protected $pk = "cat_id";
    //时间戳自动维护
    protected $autoWriteTimestamp = ture;
}