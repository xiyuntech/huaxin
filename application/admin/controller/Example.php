<?php

namespace app\admin\controller;

use app\common\model\Example as ExampleModel;
class Example extends Base{

    public $title='案例管理';



    public function index(){
        $examples=ExampleModel::where('status','<>',-1)->order(['create_time'=>'desc'])->paginate(config('admin.pageSize'));
        return $this->fetch('index',compact('examples'));
    }


    public function add(){
        if(request()->isAjax()){
            $data=validate('example')->scene('create')->go_check();
            return json(ExampleModel::add($data));
        }
        return $this->fetch('add');
    }


    public function edit(){
        $example=$this->checkId();
        if(request()->isAjax()){
            $data=validate('example')->scene('update')->go_check();
            return json(ExampleModel::edit($data));
        }
        return $this->fetch('edit',compact('example'));
    }


}