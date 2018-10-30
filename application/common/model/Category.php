<?php

namespace app\common\model;


use app\lib\exception\UserException;
use think\Db;

class Category extends Base{



    public static function getCategories($page,$count){
        if($count>=20){
            $count=20;
        }
        $cates=self::where(['status'=>self::IS_SHOW])
            ->order(['create_time'=>'desc'])
            ->field('id,name,cover,descr')
            ->limit(($page-1)*$count,$count)
            ->select();
        foreach($cates as $k=>$cate){
            $cates[$k]['cover']=request()->domain().$cate['cover'];
        }
        return $cates;
    }


    public static function getCategory($id){
        $category=self::where(['status'=>self::IS_SHOW])
            ->where(['id'=>$id])
            ->field('id,name,cover,descr,remark,ads,phone')
            ->find();
        if(!$category){
            return [];
        }
        $category['cover']=request()->domain().$category['cover'];
        $category['type']=config('admin.product_type');
        $category['min_price']=self::getMinPrice($category['id']);
        return $category;
    }

    protected static function getMinPrice($id){
        $res = Db::query('SELECT MIN(b.format_price) AS m_price
                    FROM product a
                    LEFT JOIN format b
                    ON a.id=b.product_id
                    WHERE a.cate_id=:cate_id',['cate_id'=>[$id,\PDO::PARAM_INT]]);
        return isset($res[0]['m_price'])?$res[0]['m_price']:0;
    }


    public static function getInfo($id){
        $category=self::where(['status'=>self::IS_SHOW,'id'=>$id])->field('name,cover')->find();
        if(!$category){
            throw new UserException(array('errorCode'=>4008,'msg'=>'检测服务类别不正确'));
        }
        $category->cover=request()->domain().$category->cover;
        return $category->toArray();
    }


}