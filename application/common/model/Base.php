<?php

namespace app\common\model;

use think\Model;

class Base extends Model{
    const IS_SHOW=1;
    protected  $autoWriteTimestamp=true;



    public static function add($post){
        try{
            self::create($post,true);
            return success('添加数据成功',[],url(strtolower(request()->controller()).'/index'));
        }catch(\Exception $e){
            return fail($e->getMessage());
        }
    }


    public static function edit($post){
        $id=isset($post['id'])?$post['id']:0;
        $model=self::where('status','<>','-1')->where('id','=',$id)->find();
        if(!$model){
            return fail('主键信息不正确');
        }
        try{
            $model->allowField(true)->save($post);
            return success('修改数据成功',[],url(strtolower(request()->controller()).'/index'));
        }catch(\Exception $e){
            return fail($e->getMessage());
        }

    }

    //过滤前端数组的指定字段
    protected static function filters($data,$filters=[]){
        foreach ($filters as $v) {
            if(isset($data[$v])){
                unset($data[$v]);
            }
        }
        return $data;
    }
}