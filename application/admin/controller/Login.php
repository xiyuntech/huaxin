<?php


namespace app\admin\controller;

use app\common\model\Admin as AdminModel;
class Login extends Base{

    public function _initialize()
    {

    }

    public function login(){
        if($this->checkIsLogin()){
            $this->redirect('index/index');exit;
        }
        if(request()->isAjax()){
            $data=validate('Login')->scene('login')->go_check();
            return json(AdminModel::LoginIn($data));
        }
        return $this->fetch('login');
    }


    public function logout(){
        session(null,'admin');
        $this->redirect('login/login');exit;
    }



}