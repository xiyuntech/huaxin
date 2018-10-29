<?php


namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\service\UserToken;
use app\api\validate\IdValidate;
use app\api\validate\PaginationValidate;
use app\api\validate\UnitValidate;
use app\common\model\Unit as UnitModel;
class User extends BaseController{

    //添加委托单位
    public function addUnit(){
        $data = (new UnitValidate())->scene('create')->goCheck();
        $uid=UserToken::getTokenVar('uid');
        return json(UnitModel::addUnit($data,$uid));
    }


    //修改委托单位
    public function updateUnit(){
        $data=(new UnitValidate())->scene('update')->goCheck();
        $uid=UserToken::getTokenVar('uid');
        return json(UnitModel::updateUnit($data,$uid));
    }

    //删除委托单位
    public function deleteUnit($id=''){
        (new IdValidate())->goCheck();
        $uid=UserToken::getTokenVar('uid');
        return json(UnitModel::deleteUnit($id,$uid));
    }

    //选中委托单位
    public function checkUnit($id=''){
        (new IdValidate())->goCheck();
        $uid=UserToken::getTokenVar('uid');
        return json(UnitModel::checkUnit($id,$uid));
    }

    //委托单位列表
    public function getUnits($page=1,$count=10){
        (new PaginationValidate())->goCheck();
        $uid=UserToken::getTokenVar('uid');
        return json(UnitModel::getUnits($page,$count,$uid));
    }
}