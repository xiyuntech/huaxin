<?php

namespace app\admin\validate;


class Category extends Base{

    protected $rule=[
        'name'=>'require|max:100',
        'cover'=>'require',
        'descr'=>'require',
        'phone'=>'require|checkPhone',
        'id'=>'require|integer'
    ];

    protected $message=[
        'name.require'=>'请填写服务分类名称',
        'name.max'=>'服务分类的名称太长了',
        'cover.require'=>'请上传分类图片',
        'descr.require'=>'请填写分类描述',
        'phone.require'=>'请填写咨询电话',
        'phone.checkPhone'=>'手机号格式不正确',
        'id.require'=>'缺少主键信息',
        'id.integer'=>'主键信息不正确'
    ];


    protected $scene=[
        'create'=>['name','cover','descr'],
        'update'=>['name','cover','descr','id']
    ];
}