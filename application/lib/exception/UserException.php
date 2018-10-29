<?php


namespace app\lib\exception;


class UserException extends BaseException{

    protected $code=400;
    protected $errorCode=4000;
    protected $msg='用户操作失败';
}