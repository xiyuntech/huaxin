<?php


namespace app\admin\controller;
use app\common\model\Banner as BannerModel;
class Banner extends Base{

    public $title='轮播图管理';

    public function index(){
        $banners = BannerModel::where('status','<>',-1)->order(['create_time'=>'desc'])->paginate(config('admin.pageSize'));
        return $this->fetch('index',compact('banners'));
    }


    public function add(){
        if(request()->isAjax()){
            $data = validate('Banner')->scene('create')->go_check();
            return json(BannerModel::add($data));
        }
        return $this->fetch('add');
    }

    public function edit(){
        $model=$this->checkId();
        if(request()->isAjax()){
            $data = validate('Banner')->scene('update')->go_check();
            return json(BannerModel::edit($data));
        }
        return $this->fetch('edit',compact('model'));
    }
}