<?php

namespace app\api\validate;

class Code extends BaseValidate{

    public $errorCode=1002;

    protected $rule=[
        'code'=>'require'
    ];


    protected $message=[
        'code.require'=>'缺少code参数'
    ];
}