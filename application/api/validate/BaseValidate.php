<?php


namespace app\api\validate;
use app\lib\exception\ParamsException;
use think\Validate;

class BaseValidate extends Validate{

    public function goCheck(){
        $param=input('param.');
        if(!$this->check($param)){
            throw new ParamsException(array('errorCode'=>$this->errorCode));
        }
        return true;
    }

    protected function checkPhone($value){
        if(!preg_match("/^1[34578]\d{9}$/", $value)){
            return false;
        }
        return true;
    }

    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {

        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return false;
    }
}