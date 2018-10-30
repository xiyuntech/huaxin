<?php


namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\service\UserToken;
use app\api\validate\OrderValidate;
use app\api\validate\PaginationValidate;
use app\common\model\ProductOrder;
class Order extends BaseController{


    public  function placeOrder(){
        $data=(new OrderValidate())->goCheck();
        $uid=UserToken::getTokenVar('uid');
        return json(ProductOrder::placeOrder($data,$uid));
    }



    public function getOrders($page=1,$count=10){
        (new PaginationValidate())->goCheck();
        $uid=UserToken::getTokenVar('uid');
        return json(ProductOrder::getOrders($page,$count,$uid));
    }
}