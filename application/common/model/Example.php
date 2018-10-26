<?php

namespace app\common\model;

class Example extends Base{


    //获取案例
    public static function getExamples($page,$count){
        if($count>=20){
            $count=20;
        }
        $examples=self::where(['status'=>self::IS_SHOW])
            ->order(['create_time'=>'desc'])
            ->field('name,descr,picture')
            ->limit(($page-1)*$count,$count)
            ->select();
        foreach($examples as $k=>$example){
            $examples[$k]['picture']=request()->domain().$example['picture'];
        }
        return $examples;
    }
}