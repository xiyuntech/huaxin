<?php

namespace app\common\model;


//委托单位模型
use app\lib\exception\UserException;

class Unit extends Base{



    public static function addUnit($data,$uid){
        $data['uid']=$uid;
        try{
            $unit=self::create($data,true);
            return ['create'=>$unit->id];
        }catch(\Exception $e){
            throw new UserException(array('code'=>500,'errorCode'=>4002));
        }

    }


    public static function updateUnit($data,$uid){
        $id=isset($data['id'])?$data['id']:0;
        $unit=self::where(['status'=>1,'id'=>$id,'uid'=>$uid])->find();
        if(!$unit){
            throw new UserException(array('code'=>400,'errorCode'=>4003));
        }
        try{
            $unit->allowField(true)->save($data);
            return ['update'=>$unit->id];
        }catch(\Exception $e){
            throw new UserException(array('code'=>500,'errorCode'=>4003));
        }
    }


    public static function deleteUnit($id,$uid){
        $unit=self::where(['status'=>1,'id'=>$id,'uid'=>$uid])->find();
        if(!$unit){
            throw new UserException(array('code'=>400,'errorCode'=>4004));
        }
        try{
            $unit->status=-1;
            $unit->save();
            return ['delete'=>$unit->id];
        }catch(\Exception $e){
            throw new UserException(array('code'=>500,'errorCode'=>4004));
        }
    }

    public static function checkUnit($id,$uid){
        $unit=self::where(['status'=>1,'id'=>$id,'uid'=>$uid])->find();
        if(!$unit){
            throw new UserException(array('code'=>400,'errorCode'=>4005));
        }
        try{
            $unit->checked=1;
            $unit->save();
            return ['checked'=>$unit->id];
        }catch(\Exception $e){
            throw new UserException(array('code'=>500,'errorCode'=>4005));
        }
    }

    public static function getUnits($page,$count,$uid){
        if($count>=20){
            $count=20;
        }
        $units=self::where(['status'=>self::IS_SHOW,'uid'=>$uid])
            ->order(['create_time'=>'desc'])
            ->field('id,name,phone,company_name,address,checked')
            ->limit(($page-1)*$count,$count)
            ->select();
        return $units;
    }
}