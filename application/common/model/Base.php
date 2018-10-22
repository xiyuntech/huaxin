<?php

namespace app\common\model;

use think\Model;

class Base extends Model{

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
        $model=self::get($id);
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
}