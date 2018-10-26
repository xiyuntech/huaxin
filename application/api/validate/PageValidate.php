<?php


namespace app\api\validate;

use app\api\validate\BaseValidate;


class PageValidate extends BaseValidate{
    public $errorCode=1004;
    protected $rule=[
        'page'=>'isPositiveInteger'
    ];
}