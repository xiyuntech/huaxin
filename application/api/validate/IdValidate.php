<?php


namespace app\api\validate;


class IdValidate extends BaseValidate{

    public $errorCode=1005;
    protected $rule=[
        'id'=>'require|isPositiveInteger'
    ];
}