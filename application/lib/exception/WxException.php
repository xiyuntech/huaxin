<?php


namespace app\lib\exception;


class WxException extends BaseException{
    protected $code=500;
    protected $msg='调用微信接口错误';
    protected $errorCode=3000;
}