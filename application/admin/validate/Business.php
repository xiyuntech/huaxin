<?php


namespace app\admin\validate;


class Business extends Base{

    protected $rule=[
        'pid'=>'require|integer',
        'name'=>'require|max:50',
        'id'=>'require|integer'
    ];

    protected $message=[
        'pid'=>'请选择上级业务分类',
        'name'=>'请填写业务分类名称',
        'id'=>'主键信息不正确'
    ];

    protected $scene=[
        'create'=>['name','pid'],
        'edit'=>['name','pid','id']
    ];
}