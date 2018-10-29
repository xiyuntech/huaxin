<?php


namespace app\api\validate;
use app\lib\exception\ParamsException;

class TrainValidate extends BaseValidate{
    public $errorCode=4007;

    public function goCheck(){
        $param=input('param.');
        if(!$this->check($param)){
            throw new ParamsException(array('errorCode'=>$this->errorCode,'msg'=>is_array($this->error)?implode(',',$this->error):$this->error));
        }
        return $param;
    }


    protected $rule=[
        'train_id'=>'require|integer',
        'username'=>'require|max:30',
        'phone'=>'require|checkPhone',
        'unit'=>'max:100',
        'job'=>'max:50'
    ];


    protected $message=[
        'train_id.require'=>'缺少培训唯一标识',
        'train_id.integer'=>'培训唯一标识格式不正确',
        'username.require'=>'请填写姓名',
        'username.max'=>'姓名太长了',
        'phone.require'=>'请填写电话',
        'phone.checkPhone'=>'电话格式不正确',
        'unit'=>'单位名称太长了',
        'job'=>'职务名称太长了'
    ];



}