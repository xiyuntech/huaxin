<?php


namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\validate\PaginationValidate;
use app\common\model\Example as ExampleModel;
class Example extends BaseController{

    public function getExamples($page=1,$count=10){
        (new PaginationValidate())->goCheck();
        return ExampleModel::getExamples($page,$count);
    }
}