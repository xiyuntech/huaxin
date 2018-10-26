<?php


namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\common\model\Info as InfoModel;

class Company extends BaseController{

    //关于我们
    public function getAboutUs(){
        return InfoModel::getAboutUs();
    }
}