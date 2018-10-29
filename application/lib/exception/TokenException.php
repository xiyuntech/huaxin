<?php


namespace app\lib\exception;

class TokenException extends BaseException{
    protected $msg='token操作失败';
    protected $errorCode=2000;
    protected $code=401;
}