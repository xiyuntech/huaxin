<?php


namespace app\admin\controller;
use app\common\model\Info as InfoModel;
class Info extends Base{

    public $title='信息设置';

    public function base(){
        $info=InfoModel::where('status',1)->order(['create_time'=>'asc'])->limit(0,1)->find();
        if(request()->isAjax()){
            $data=validate('info')->scene('update')->go_check();
            return json(InfoModel::addOrUpdateInfo($data));
        }
        return $this->fetch('base',compact('info'));
    }

    //覆盖父类的方法
    public function delete()
    {

    }

    //覆盖父类的方法
    public function changeStatus()
    {

    }

}