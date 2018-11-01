<?php


namespace app\admin\validate;

class Login extends Base{

    protected $rule=[
        'username'=>'require',
        'password'=>'require'
    ];


    protected $message=[
        'username'=>'请填写用户名',
        'password'=>'请填写密码'
    ];


    protected $scene=[
        'login'=>['username','password']
    ];
}