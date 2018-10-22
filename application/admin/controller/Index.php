<?php

namespace app\admin\controller;

class Index extends Base{
    public $title='后台首页';
    public function index(){
        return $this->fetch('index');
    }
}