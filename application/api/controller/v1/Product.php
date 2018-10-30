<?php


namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\ProductValidate;


class Product extends BaseController{


    public function getProducts($cate_id='',$type_id='',$page=1,$count=10){
        (new ProductValidate())->goCheck();
        return json(\app\common\model\Product::getProducts($cate_id,$type_id,$page,$count));
    }
}