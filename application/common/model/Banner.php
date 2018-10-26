<?php

namespace app\common\model;

class Banner extends Base{

    public static function getBanners($count){
        $banners=self::where(['status'=>self::IS_SHOW])
            ->order(['create_time'=>'desc'])
            ->field('path,descr,href')
            ->limit($count)
            ->select();
        foreach($banners as $k=>$v){
            $banners[$k]['path']=request()->domain().$v['path'];
        }
        return $banners;
    }
}