<?php

namespace app\lib\exception;

use think\Exception;

//只有继承了\Exception类才能使用抛出关键字：throw
//think\Exception继承了\Exception
class BaseException extends Exception{

    protected $msg='请求错误';
    protected $errorCode=1000;
    protected $code=400;


    public function __construct($params=array())
    {

        if(!is_array($params)){
            return;
        }

        if(array_key_exists('msg',$params)){
            $this->msg=$params['msg'];
        }

        if(array_key_exists('errorCode',$params)){
            $this->errorCode=$params['errorCode'];
        }

        if(array_key_exists('code',$params)){
            $this->code=$params['code'];
        }
    }

    public function __set($name,$value){
        $this->$name=$value;
    }

    public function __get($name){
        if(!isset($this->$name)){
            return '';
        }
        return $this->$name;
    }
}