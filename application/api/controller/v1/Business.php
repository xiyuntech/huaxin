<?php


namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\common\model\Business as BusinessModel;

class Business extends BaseController{


    public function getBusinesses(){
        return json(BusinessModel::getBusinesses());
    }
}