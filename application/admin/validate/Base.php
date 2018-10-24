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
}