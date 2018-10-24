<?php

namespace app\common\model;
use think\Db;
class Product extends Base{

    public static function addProduct($data){
        $format_name=isset($data['format_name'])?$data['format_name']:null;
        $format_price=isset($data['format_price'])?$data['format_price']:null;
        if(!is_array($format_price)||!is_array($format_name)||empty($format_name[0])||empty($format_price[0])){
            return fail('请至少填写一个规格');
        }
        if(count($format_name)!=count($format_price)){
            return fail('规格参数中名称和价格数量不匹配');
        }
        Db::startTrans();
        try{
            $product=self::create($data,true);
            $format=[];
            foreach($format_name as $k=>$v){
                if(empty($v)||empty($format_price[$k])){
                    continue;
                }
                $format[]=['product_id'=>$product->id,'format_name'=>$v,'format_price'=>$format_price[$k]];
            }
            $f=new Format();
            $f->saveAll($format);
            Db::commit();
            return success('添加产品成功',[],url('product/index'));
        }catch(\Exception $e){
            Db::rollback();
            return fail('添加产品失败，请稍后重试');
        }
    }

    //获取产品的规格信息
    public function getFormat(){
        return $this->hasMany(Format::class,'product_id','id')->field('format_name,format_price');
    }

    //获取服务分类
    public function getCategory(){
        return $this->belongsTo(Category::class,'cate_id','id')->field('name');
    }
}