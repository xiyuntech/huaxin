<?php


namespace app\common\model;

use app\lib\exception\UserException;

class TrainOrder extends Base{


    public static function enrollTrain($data,$uid){
        $data=self::filters($data,array('id','uid'));
        $train=Train::where(['status'=>1,'id'=>$data['train_id']])
                ->where('begin_time','>',time())
                ->field('picture,id,name,price,begin_time')->find();
        if(!$train){
            throw new UserException(array('errorCode'=>'4007'));
        }
        try{
            $order=self::create([
                'orderno'=>build_order_no(),
                'uid'=>$uid,
                'order_price'=>$train['price'],
                'train_id'=>$train['id'],
                'username'=>$data['username'],
                'phone'=>$data['phone'],
                'unit'=>isset($data['unit'])?$data['unit']:'',
                'job'=>isset($data['job'])?$data['job']:'',
                'detail'=>serialize($train->toArray())
            ]);
            return ['create'=>$order->id];
        }catch(\Exception $e){
            throw new UserException(array('code'=>500,'errorCode'=>4007));
        }
    }

    public static function getTrains($page,$count,$uid){
        if($count>=20){
            $count=20;
        }
        $trains=self::where('status','<>',self::IS_DELETE)
            ->where(['uid'=>$uid])
            ->field('order_price,status,username,phone,detail,train_id')
            ->order(['create_time'=>'desc'])
            ->limit(($page-1)*$count,$count)
            ->select();
        $res=[];
        foreach($trains as $k=>$train){
            $detail=unserialize($train['detail']);
            $res[]=array(
                'price'=>$train['order_price'],
                'status'=>$train['status'],
                'username'=>$train['username'],
                'phone'=>$train['phone'],
                'train_id'=>$train['train_id'],
                'train_name'=>$detail['name'],
                'open_time'=>date('Y-m-d H:i',$detail['begin_time']),
                'cover'=>request()->domain().$detail['picture']
            );
        }
        return $res;
    }
}