<?php


namespace app\common\model;

class Train extends Base{

    protected $dateFormat=false;

    //获取培训列表
    public static function getTrains($page,$count){
        //只获取没有过期的培训
        $trains=self::where(['status'=>self::IS_SHOW])
            ->field('id,name,picture,descr')
            ->where('begin_time','>',time())
            ->order(['create_time'=>'desc'])
            ->limit(($page-1)*$count,$count)
            ->select();
        foreach($trains as $k=>$train){
            $trains[$k]['picture']=request()->domain().$train['picture'];
        }
        return $trains;
    }


    //获取培训详情
    public static function getTrainDetail($id){
        $train=self::where(['status'=>self::IS_SHOW])
            ->where('begin_time','>',time())
            ->where(['id'=>$id])
            ->field('id,name,picture,descr,content,price,begin_time')
            ->find();
        if(!$train){
            return [];
        }
        $train['picture']=request()->domain().$train['picture'];
        $train['begin_time']=date('Y-m-d H:i',$train['begin_time']);
        return $train;
    }
}