<?php


namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\IdValidate;
use app\api\validate\PaginationValidate;
use app\common\model\Category as CategoryModel;

class Category extends BaseController{

    //检测服务列表
    public function getCategories($page=1,$count=10){
        (new PaginationValidate())->goCheck();
        return json(CategoryModel::getCategories($page,$count));
    }

    //检测服务详情
    public function getCategory($id=''){
        (new IdValidate())->goCheck();
        return json(CategoryModel::getCategory($id));
    }
}