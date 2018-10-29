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
}