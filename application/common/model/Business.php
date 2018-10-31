<?php


namespace app\common\model;

use think\Db;

class Business extends Base{


    public static function add($data){
        if($data['pid']==0){
            $cover='';
        }else{
            $cover=isset($data['cover'])?$data['cover']:'';
            if(!$cover){
                return fail('请上传业务分类图片');
            }
        }
        try{
            self::create([
                'name'=>$data['name'],
                'pid'=>$data['pid'],
                'cover'=>$cover
            ]);
            return success('添加业务分类成功',[],url('business/index'));
        }catch(\Exception $e){
            return fail($e->getMessage());
        }
    }


    public static function edit($data){
        $id=isset($data['id'])?$data['id']:0;
        $model=self::where('status','<>','-1')->where('id','=',$id)->find();
        if(!$model){
            return fail('主键信息不正确');
        }
        if($data['pid']==0){
            $cover='';
        }else{
            $cover=isset($data['cover'])?$data['cover']:'';
            if(!$cover){
                return fail('请上传业务分类图片');
            }
        }
        try{
            $model->cover=$cover;
            $model->pid=$data['pid'];
            $model->name=$data['name'];
            $model->save();
            return success('修改业务分类成功',[],url('business/index'));
        }catch(\Exception $e){
            return fail($e->getMessage());
        }
    }

    //无限极分类
    public static function getTree(){
        $data=self::where('status','<>',-1)->order(['create_time'=>'desc'])->select();
        return self::_getTree($data);
    }

    public static function _getTree($data,$pid=0,$level=1){
        $res=[];
        foreach ($data as $d) {
            if($d['pid']==$pid){
                $d['level']=$level;
                $res[]=$d;
                $res=array_merge($res,self::_getTree($data,$d['id'],$level+1));
            }
        }
        return $res;
    }

    //获取一个类目的子分类
    public static function getChildren($id){
        $data=self::where('status','<>',-1)->order(['create_time'=>'desc'])->select();
        return array_merge([$id],self::_getChildren($data,$id));
    }

    public static function _getChildren($data,$id){
        $res=[];
        foreach($data as $d){
            if($d['pid']==$id){
                $res[]=$d['id'];
                $res=array_merge($res,self::_getChildren($data,$d['id']));
            }
        }
        return $res;
    }


    public static function getBusinesses(){
        $res=Db::query("SELECT a.id,a.name,b.name AS child_name,b.cover AS child_cover
                  FROM business AS a
                  INNER JOIN business AS b
                  ON a.id=b.pid WHERE a.pid=:pid AND a.status=1 AND b.status=1
                  ORDER BY a.create_time DESC",['pid'=>0]);
        $business=[];
        foreach($res as $r){
            $business[$r['name']][]=array('name'=>$r['child_name'],'cover'=>request()->domain().$r['child_cover']);
        }
        $res=[];
        foreach($business as $k=>$b){
            $res[]=array('parent'=>$k,'children'=>$b);
        }
        return $res;
    }
}