<?php


namespace app\api\validate;

use app\lib\exception\ParamsException;

class PaginationValidate extends BaseValidate{

    protected $rule=[
        'page'=>'checkPage',
        'count'=>'checkCount',

    ];


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