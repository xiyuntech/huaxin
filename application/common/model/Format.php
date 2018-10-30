<?php

namespace app\common\model;


class Format extends Base{

    public function getProduct(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}