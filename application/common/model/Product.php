<?php

namespace app\common\model;
use think\Db;
class Product extends Base{

    public static function addProduct($data){
        list($format_name,$format_price)=self::checkFormatParams($data);
        Db::startTrans();
        try{
            $product=self::create($data,true);
            self::addFormat($product->id,$format_name,$format_price);
            Db::commit();
            return success('添加产品成功',[],url('product/index'));
        }catch(\Exception $e){
            Db::rollback();
            return fail('添加产品失败，请稍后重试');
        }
    }
    //修改产品
    public static function editProduct($post){
        $id=isset($post['id'])?$post['id']:0;
        $model=self::where('status','<>','-1')->where('id','=',$id)->find();
        if(!$model){
            return fail('主键信息不正确');
        }
        list($format_name,$format_price)=self::checkFormatParams($post);
        Db::startTrans();
        try{
            //更新产品表
            $model->allowField(true)->save($post);
            //删除原来的规格数据
            Format::where(['product_id'=>$model->id])->delete();
            self::addFormat($model->id,$format_name,$format_price);
            Db::commit();
            return success('修改产品成功',[],url('product/index'));
        }catch(\Exception $e){
            Db::rollback();
            return fail('修改产品失败，请稍后重试');
        }
    }

    protected static function checkFormatParams($data){
        $format_name=isset($data['format_name'])?$data['format_name']:null;
        $format_price=isset($data['format_price'])?$data['format_price']:null;
        if(!is_array($format_price)||!is_array($format_name)||empty($format_name[0])||empty($format_price[0])){
            echo json_encode(fail('请至少填写一个规格'));exit;
        }
        if(count($format_name)!=count($format_price)){
            echo json_encode(fail('规格参数中名称和价格数量不匹配'));exit;
        }
        return [$format_name,$format_price];
    }

    protected static function addFormat($product_id,$format_name,$format_price){
        $format=[];
        foreach($format_name as $k=>$v){
            if(empty($v)||empty($format_price[$k])){
                continue;
            }
            $format[]=['product_id'=>$product_id,'format_name'=>$v,'format_price'=>$format_price[$k]];
        }
        $f=new Format();
        $f->saveAll($format);
    }

    //删除产品(这里使用软删除，其实也可以硬删除，因为这部分数据以后回溯的可能心比较小)
    public function deleteProduct(){
        DB::startTrans();
        try{
            $this->status=-1;
            $this->save();
            Format::where(['product_id'=>$this->id])->update(['status'=>-1]);
            Db::commit();
            return success('删除记录成功');
        }catch(\Exception $e){
            Db::rollback();
            return fail('删除记录失败');
        }
    }


    //获取产品的规格信息
    public function getFormat(){
        return $this->hasMany(Format::class,'product_id','id')->field('format_name,format_price')->where(['status'=>1]);
    }

    //获取服务分类
    public function getCategory(){
        return $this->belongsTo(Category::class,'cate_id','id')->field('name');
    }
}