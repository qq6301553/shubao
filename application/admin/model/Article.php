<?php
namespace  app\admin\model;
use think\Model;
class Article extends Model{
    //时间戳自动维护
    protected $autoWriteTimestamp = true;
}