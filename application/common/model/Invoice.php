<?php


namespace app\common\model;

use app\lib\exception\UserException;

class Invoice extends Base{


    public static function getInvoiceByUid($uid){
        $invoice=self::where(['uid'=>$uid,'status'=>1])
            ->field('id,name,duty,address,phone,account,open_name')
            ->limit(0,1)
            ->find();
        return $invoice?:[];
    }


    public static function createOrUpdateInvoice($data,$uid){
        $invoice=self::where(['uid'=>$uid,'status'=>1])
            ->limit(0,1)
            ->find();
        $data=self::filters($data,array('id','uid'));
        try{
            if($invoice){
                //更新
                $invoice->allowField(true)->save($data);
                return ['setting'=>$invoice->id];
            }else{
                //新增
                $data['uid']=$uid;
                $invoice = self::create($data,true);
                return ['setting'=>$invoice->id];
            }
        }catch(\Exception $e){
            throw new UserException(array('code'=>500,'errorCode'=>4006));
        }

    }
}