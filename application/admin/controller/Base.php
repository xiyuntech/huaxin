<?php


namespace app\admin\controller;
use think\Controller;


class Base extends Controller{

    protected function checkIsLogin(){
        $user=session('user','','admin');
        if(!$user){
            return false;
        }
        return true;
    }
    public function _initialize()
    {
        if(!$this->checkIsLogin()){
            $this->redirect('login/login');exit;
        }
        $this->assign([
            'title'=>$this->title
        ]);
    }

    public function delete(){
        $model=$this->checkId();
        try{
            $model->status=-1;
            $model->save();
            return json(success('删除记录成功'));
        }catch(\Exception $e){
            return json(fail('删除记录失败'));
        }
    }

    public function changeStatus(){
        $model=$this->checkId();
        $model->status=$model->status==1?0:1;
        try{
            $model->save();
            return json(success('修改状态成功',['flag'=>$model->status]));
        }catch(\Exception $e){
            return json(fail('修改状态失败'));
        }
    }


    protected function checkId(){
        $id=input('param.id');
        $model = '\app\common\model\\'.request()->controller();
        $model= new $model;
        $model = $model->where('status','<>','-1')->where('id','=',$id)->find();
        if(!$model){
            if(request()->isAjax()){
                echo json_encode(fail('id参数不合法'));exit;
            }else{
                $this->redirect(request()->controller().'/index');
            }

        }
        return $model;
    }
}