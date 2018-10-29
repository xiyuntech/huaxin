<?php


namespace app\api\validate;
use app\lib\exception\ParamsException;

class InvoiceValidate extends BaseValidate{

    public $errorCode=4006;
    public function goCheck(){
        $param=input('param.');
        if(!$this->check($param)){
            throw new ParamsException(array('errorCode'=>$this->errorCode,'msg'=>is_array($this->error)?implode(',',$this->error):$this->error));
        }
        return $param;
    }
    protected $rule=[
        'name'=>'require|max:100',
        'duty'=>'max:30',
        'address'=>'max:150',
        'phone'=>'checkPhone|max:11',
        'open_name'=>'max:100',
        'account'=>'max:50',
    ];


    protected $message=[
        'name.require'=>'请填写单位名称',
        'phone.checkPhone'=>'手机号格式错误'
    ];




}