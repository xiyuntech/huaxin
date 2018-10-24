<?php


namespace app\admin\controller;


class Product extends Base{

    public $title='检测产品管理';

    public function index(){
        return $this->fetch('index');
    }


    public function add(){
        return $this->fetch('add');
    }
}