<?php


namespace app\lib\exception;

class ParamsException extends BaseException{
    protected $code=400;
    protected $msg='参数验证失败';
    protected $errorCode=1001;

}