<?php

namespace app\admin\validate;

class Product extends Base{


    protected $rule=[
        'cate_id'=>'require|integer',
        'type_id'=>'require|integer|checkValue',
        'name'=>'require|max:100',
        'img'=>'require',
        'id'=>'require|integer'
    ];


    protected $message=[
        'cate_id.require'=>'请选择服务类型',
        'cate_id.integer'=>'服务类型格式错误',
        'type_id.require'=>'请选择检测类型',
        'type_id.integer'=>'检测类型格式错误',
        'type_id.checkValue'=>'检测类型格式错误',
        'name.require'=>'请填写产品名称',
        'name.max'=>'产品名称太长了',
        'img.require'=>'请上传产品图片',
        'id.require'=>'缺少主键信息',
        'id.integer'=>'主键格式不正确'
    ];

    protected function checkValue($value, $rule, $data){
        if(!in_array($value,array_keys(config('admin.product_type')))){
            return false;
        }
        return true;
    }


    protected $scene=[
        'create'=>['cate_id','type_id','name','img']
    ];
}