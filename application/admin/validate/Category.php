<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate{
    //添加验证规则
    protected $rule= [
        'cat_name' => 'require|unique:category',
        'pid' => 'require'
    ];
    //错误信息
    protected $message = [
        'cat_name.require' => '分类名称必填',
        'cat_name.unique' => '分类名称重复',
        'pid' => '必须选择一个分类',
    ];
    //定义使用的场景
    protected $scene = [
        //场景名=>[规则名称=>规则1|规则2]
        'add' => ['cat_name','pid'],
        'upd' => ['cat_name','pid']
    ];
}