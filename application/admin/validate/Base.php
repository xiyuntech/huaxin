<?php

namespace app\admin\validate;
use think\Validate;


class Base extends Validate{

    public function go_check(){
        $param = input('post.');
        if(!$this->check($param)){
            echo json_encode(fail($this->error));exit;
        }
        return $param;
    }

    protected function checkPhone($value){
        if(!preg_match("/^1[34578]\d{9}$/", $value)){
            return false;
        }
        return true;
    }
}