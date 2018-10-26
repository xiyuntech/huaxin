<?php


namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\common\model\Banner as BannerModel;
use app\api\validate\CountValidate;
class Banner extends BaseController{

    public function getBanners($count=3){
        (new CountValidate())->goCheck();
        return BannerModel::getBanners($count);
    }
}