<?php


namespace app\admin\controller;
use app\common\model\Business as BusinessModel;
class Business extends Base{

    public $title='业务管理';

    public function index(){
        $business=BusinessModel::getTree();
        return $this->fetch('index',compact('business'));
    }


    public function add(){
        if(request()->isAjax()){
            $data=validate('business')->scene('create')->go_check();
            return json(BusinessModel::add($data));
        }
        $business=BusinessModel::getTree();
        return $this->fetch('add',compact('business'));
    }


    public function edit(){
        $busi=$this->checkId();
        if(request()->isAjax()){
            $data=validate('business')->scene('edit')->go_check();
            return json(BusinessModel::edit($data));
        }
        $business=BusinessModel::getTree();
        $children=BusinessModel::getChildren($busi->id);
        return $this->fetch('edit',compact('business','busi','children'));
    }


    public function delete(){
        $model=$this->checkId();
        $chidlren=BusinessModel::getChildren($model->id);
        if(count($chidlren)>=2){
            return json(fail('存在子业务分类，删除失败'));
        }
        try{
            $model->status=-1;
            $model->save();
            return json(success('删除记录成功'));
        }catch(\Exception $e){
            return json(fail('删除记录失败'));
        }
    }


}