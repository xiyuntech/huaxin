<?php


namespace app\admin\controller;
use app\common\model\Admin as AdminModel;

class Admin extends Base{
    public $title='管理员管理';

    public function index(){
        $admins=AdminModel::where('status','<>',-1)->order(array('create_time'=>'desc'))->paginate(config('admin.pageSize'));
        return $this->fetch('index',compact('admins'));
    }


    public function add(){
        if(request()->isAjax()){
            $data=validate('Admin')->scene('create')->go_check();
            return json(AdminModel::add($data));
        }
        return $this->fetch();
    }


    public function edit(){
        $admin=$this->checkId();
        if(request()->isAjax()){
            $data=validate('admin')->scene('update')->go_check();
            return json(AdminModel::edit($data));
        }
        return $this->fetch('edit',compact('admin'));
    }
}