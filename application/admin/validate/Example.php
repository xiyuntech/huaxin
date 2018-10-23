<?php

namespace app\admin\validate;


class Example extends Base{

    protected $rule=[
        'name'=>'require|unique:example|max:100',
        'picture'=>'require'
    ];


    protected $message=[
        'name.require'=>'请填写案例名称',
        'name.unique'=>'该案例名称已经存在',
        'name.max'=>'案例名称太长了'
    ];


    protected $scene=[
        'create'=>['name','picture'],
        'update'=>['name','picture']
    ];
}