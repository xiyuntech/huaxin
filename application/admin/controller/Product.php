<?php


namespace app\admin\controller;
use app\common\model\Category as CategoryModel;
use app\common\model\Product as ProductModel;
class Product extends Base{

    public $title='检测产品管理';

    public function index(){
        $products=ProductModel::where('status','<>',-1)->order(['create_time'=>'desc'])->paginate(config('admin.pageSize'));
        return $this->fetch('index',compact('products'));
    }


    public function add(){
        if(request()->isAjax()){
            $data=validate('product')->scene('create')->go_check();
            return json(ProductModel::addProduct($data));
        }
        $cates=CategoryModel::where('status','<>','-1')->field('id,name')->order(['create_time'=>'desc'])->select();
        return $this->fetch('add',compact('cates'));
    }
}