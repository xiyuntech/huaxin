<?php

namespace app\admin\validate;


class Example extends Base{

    protected $rule=[
        'name'=>'require|max:100',
        'picture'=>'require',
        'id'=>'require|integer'
    ];


    protected $message=[
        'name.require'=>'请填写案例名称',
        'name.max'=>'案例名称太长了',
        'id.require'=>'缺少主键信息',
        'id.integer'=>'主键格式不正确'
    ];


    protected $scene=[
        'create'=>['name','picture'],
        'update'=>['name','picture','id']
    ];
}