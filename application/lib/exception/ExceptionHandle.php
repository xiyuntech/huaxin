<?php


namespace app\lib\exception;
use think\exception\Handle;
use think\exception\HttpException;

class ExceptionHandle extends Handle{

    protected $msg;
    protected $errorCode;
    protected $code;
    public function render(\Exception $e){
        if($e instanceof BaseException){
            $this->msg=$e->msg;
            $this->errorCode=$e->errorCode;
            $this->code=$e->code;
        }else{
            if(config('app_debug')){
                return parent::render($e);
            }else{
                if($e instanceof HttpException){
                    $this->msg='请求错误';
                    $this->errorCode=1000;
                    $this->code=400;
                }else{
                    $this->msg='服务器未知错误';
                    $this->errorCode=9999;
                    $this->code=500;
                }
            }
        }
        return json(['msg'=>$this->msg,'errorCode'=>$this->errorCode,'request_url'=>request()->url()],$this->code);
    }
}