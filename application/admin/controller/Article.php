<?php

namespace app\admin\controller;
use app\common\model\Article as ArticleModel;
class Article extends Base{

    public $title='咨询管理';

    public function index(){
        $articles=ArticleModel::where('status','<>',-1)->order(['create_time'=>'desc'])->paginate(config('admin.pageSize'));
        return $this->fetch('index',compact('articles'));
    }


    public function add(){
        if(request()->isAjax()){
            $data=validate('article')->scene('create')->go_check();
            return json(ArticleModel::add($data));
        }
        return $this->fetch('add');
    }

    public function edit(){
        $article=$this->checkId();
        if(request()->isAjax()){
            $data=validate('article')->scene('update')->go_check();
            return json(ArticleModel::edit($data));
        }
        return $this->fetch('edit',compact('article'));
    }
}