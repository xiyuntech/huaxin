<?php


namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\validate\Code;
use app\api\service\UserToken;
//获取令牌
class Token extends BaseController{

    public function get($code=''){
        (new Code())->goCheck();
        $token = (new UserToken($code))->get();
        return [
            'token'=>$token
        ];
    }
}