<?php


namespace app\api\validate;


class CountValidate extends BaseValidate{
    public $errorCode=1003;
    protected $rule=[
        'count'=>'isPositiveInteger'
    ];
}