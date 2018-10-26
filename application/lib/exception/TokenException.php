<?php


namespace app\lib\exception;

class TokenException extends BaseException{
    protected $msg='用户认证错误';
    protected $errorCode=2000;
    protected $code=401;
}