<?php


namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\IdValidate;
use app\api\validate\PaginationValidate;
use app\common\model\Train as TrainModel;
class Train extends BaseController{

    //培训列表
    public function getTrains($page=1,$count=10){
        (new PaginationValidate())->goCheck();
        return TrainModel::getTrains($page,$count);
    }


    //培训详情
    public function getTrainDetail($id=''){
        (new IdValidate())->goCheck();
        return TrainModel::getTrainDetail($id);
    }
}