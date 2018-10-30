<?php

namespace app\api\validate;
use app\lib\exception\ParamsException;
class OrderValidate extends BaseValidate{
    public $errorCode=4008;

    public function goCheck(){
        $param=input('param.');
        if(!$this->check($param)){
            throw new ParamsException(array('errorCode'=>$this->errorCode,'msg'=>is_array($this->error)?implode(',',$this->error):$this->error));
        }
        return $param;
    }


    protected $rule=[
        'company_name'=>'require|max:100',
        'address'=>'require|max:100',
        'concat_name'=>'require|max:50',
        'concat_phone'=>'require|checkPhone',
        'area'=>'require|max:100',
        'type_id'=>'require|integer',
        'cate_id'=>'require|integer',
        'sum'=>'require|float',
        'products'=>'require|array|checkProducts',
        'remark'=>'max:100'
    ];

    protected function checkProducts($value){
        if(!is_array($value)){
            return false;
        }
        foreach($value as $k=>$v){
            if(!$this->isPositiveInteger($v)||!$this->isPositiveInteger($k)){
                return false;
            }
        }
        return true;
    }
    protected $message=[
        'company_name'=>'委托单位不能为空',
        'address'=>'委托单位地址不能为空',
        'concat_name'=>'联系人不能为空',
        'concat_phone.require'=>'联系电话不能为空',
        'concat_phone.checkPhone'=>'联系电话格式不对',
        'area'=>'地区不能为空',
        'type_id'=>'检测类型不能为空',
        'cate_id'=>'检测服务类别不能为空',
        'sum'=>'总价不能为空',
        'products.require'=>'产品不能为空',
        'products.array'=>'产品参数格式错误',
        'products.checkProducts'=>'产品参数中键和值必须是正整数',
        'remark.max'=>'备注信息太长了'
    ];
}