<?php


namespace app\admin\validate;


class Banner extends Base{


    protected $rule=[
        'path'=>'require',
        'href'=>'max:100|url',
        'id'=>'require|integer'
    ];


    protected $message=[
        'path.require'=>'请上传轮播图',
        'href.max'=>'跳转地址不能超过100个字符',
        'href.url'=>'跳转地址格式不正确',
        'id.require'=>'缺少主键信息',
        'id.integer'=>'主键格式不正确'
    ];


    protected $scene=[
        'create'=>['path','href'],
        'update'=>['path','href','id']
    ];



}