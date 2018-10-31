<?php


namespace app\admin\validate;
class Admin extends Base{

    protected $rule=[
        'username'=>'require|max:50',
        'password'=>'require',
        'id'=>'require|integer'
    ];


    protected $message=[
        'username.require'=>'用户名不能为空',
        'username.max'=>'用户名太长了',
        'password'=>'密码不能为空',
        'id.require'=>'缺少主键信息',
        'id.integer'=>'主键格式不正确'
    ];



    protected $scene=[
        'create'=>['username','password'],
        'update'=>['username','password','id']
    ];
}