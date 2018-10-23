<?php


namespace app\admin\controller;
use app\common\model\Train as TrainModel;
class Train extends Base{

    public $title='培训管理';


    public function index(){
        $trains=TrainModel::where('status','<>',-1)->order(['create_time'=>'desc'])->paginate(config('admin.pageSize'));
        return $this->fetch('index',compact('trains'));
    }


    public function add(){
        if(request()->isAjax()){
            $data=validate('train')->scene('create')->go_check();
            $data['begin_time']=strtotime($data['begin_time']);
            return json(TrainModel::add($data));
        }
        return $this->fetch('add');
    }


    public function edit(){
        $train=$this->checkId();
        if(request()->isAjax()){
            $data=validate('train')->scene('update')->go_check();
            $data['begin_time']=strtotime($data['begin_time']);
            return json(TrainModel::edit($data));
        }
        return $this->fetch('edit',compact('train'));
    }
}