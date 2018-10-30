<?php


namespace app\api\validate;

use app\lib\exception\ParamsException;

class ProductValidate extends BaseValidate{
    public $errorCode=1005;
    protected $rule=[
        'cate_id'=>'require|checkId',
        'type_id'=>'require|checkId',
        'page'=>'checkPage',
        'count'=>'checkCount'
    ];


    protected function checkId($value){
        $id=new IdValidate();
        if(!$id->check(['id'=>$value])){
            throw new ParamsException(array('errorCode'=>$id->errorCode));
        }
        return true;
    }

    protected function checkCount($value){
        $count=new CountValidate();
        if(!$count->check(['count'=>$value])){
            throw new ParamsException(array('errorCode'=>$count->errorCode));
        }
        return true;
    }


    protected function checkPage($value){
        $page=new PageValidate();
        if(!$page->check(['page'=>$value])){
            throw new ParamsException(array('errorCode'=>$page->errorCode));
        }
        return true;
    }
}