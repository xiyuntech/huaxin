<?php

namespace app\admin\controller;
use app\common\model\Category as CategoryModel;

class Category extends  Base{
    public $title='服务分类管理';


    public function index(){
        $categorys=CategoryModel::where('status','<>',-1)->order(['create_time'=>'desc'])->paginate(config('admin.pageSize'));
        return $this->fetch('index',compact('categorys'));
    }


    public function add(){
        if(request()->isAjax()){
            $data=validate('category')->scene('create')->go_check();
            return json(CategoryModel::add($data));
        }
        return $this->fetch('add');
    }

    public function edit(){
        $cate=$this->checkId();
        if(request()->isPost()){
            $data=validate('category')->scene('update')->go_check();
            return json(CategoryModel::edit($data));
        }
        return $this->fetch('edit',compact('cate'));
    }
}