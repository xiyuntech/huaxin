<?php


namespace app\common\model;

use app\lib\exception\UserException;

class ProductOrder extends Base{



    public static function placeOrder($data,$uid){
        $data=self::filters($data,array('uid','id'));
        $products=$data['products'];
        $sum=0;
        $detail=[];
        foreach($products as $k=>$v){
            $format=Format::field('id,format_name,format_price,product_id')->where(['status'=>self::IS_SHOW,'id'=>$k])->find();
            if(!$format){
                throw new UserException(array('errorCode'=>4008,'msg'=>'规格错误'));
            }
            $detail[]=array(
                'count'=>$v,
                'format_id'=>$format->id,
                'format_name'=>$format->format_name,
                'format_price'=>$format->format_price,
                'product_id'=>$format->product_id,
                'product_name'=>$format->getProduct['name']
            );
            $sum+=$format->format_price*$v;
        }
        if($sum!=$data['sum']){
            throw new UserException(array('errorCode'=>4008,'msg'=>'价格不一致'));
        }
        try{
            $info=Category::getInfo($data['cate_id']);
            $order=self::create([
                'company_name'=>$data['company_name'],
                'address'=>$data['address'],
                'concat_name'=>$data['concat_name'],
                'concat_phone'=>$data['concat_phone'],
                'area'=>$data['area'],
                'type_id'=>$data['type_id'],
                'cate_id'=>$data['cate_id'],
                'category_info'=>serialize($info),
                'price'=>$sum,
                'order_no'=>build_order_no(),
                'uid'=>$uid,
                'order_detail'=>serialize($detail),
                'remark'=>isset($data['remark'])?$data['remark']:''
            ]);
            return [
                'account'=>
                Info::getAccount()
            ];
        }catch(\Exception $e){
            throw new UserException(array('errorCode'=>4008,'code'=>500));
        }
    }


    public static function getOrders($page,$count,$uid){
        if($count>=20){
            $count=20;
        }
        $orders=self::where('status','<>',self::IS_DELETE)
            ->where(['uid'=>$uid])
            ->order(['create_time'=>'desc'])
            ->limit(($page-1)*$count,$count)
            ->select();
        $res=[];
        foreach($orders as $k=>$order){
            $category=unserialize($order['category_info']);
            $products=self::getProductDetail($order['order_detail']);
            $res[]=array(
                'order_no'=>$order['order_no'],
                'status'=>$order['status'],
                'category_cover'=>$category['cover'],
                'category_title'=>$category['name'],
                'sum_price'=>$order['price'],
                'type'=>config('admin.product_type')[$order['type_id']],
                'detail'=>$products
            );
        }
        return $res;
    }

    protected static function getProductDetail($detail){
        $products=unserialize($detail);
        foreach($products as $k=>$product){
            unset($products[$k]['product_id']);
            unset($products[$k]['format_id']);
        }
        return $products;
    }
}