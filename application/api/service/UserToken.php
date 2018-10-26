<?php


namespace app\api\service;

use app\lib\exception\TokenException;
use app\lib\exception\WxException;
use app\common\model\User as UserModel;
use think\Cache;

class UserToken extends Token{


    private $AK;
    private $AS;
    private $loginUrl;

    public function __construct($code)
    {
        $this->AK=config('api.AK');
        $this->AS=config('api.AS');
        $this->loginUrl=sprintf(config('api.loginUrl'),$this->AK,$this->AS,$code);
    }


    /*
     * 微信的错误返回
     * array(2) {
          ["errcode"]=>
          int(40013)
          ["errmsg"]=>
          string(48) "invalid appid, hints: [ req_id: mvRFoa06273028 ]"
        }
     *
     *
     * 微信的正确返回
     * array(2) {
          ["session_key"]=>
          string(24) "WiMIRrrf3QS4qdJ4zIDILw=="
          ["openid"]=>
          string(28) "okADm5SaJPsG4-eyGfzcW79HFSXY"
        }
     * */

    public function get(){
        //如果result返回false即请求loginUrl失败，可能是code不合法,url错误等
        $result=curl_get($this->loginUrl);
        //false结果经过decode之后返回null，因此下面采用empty判断
        $result=json_decode($result,true);
        if(empty($result)){
            throw new WxException(array(
                'errorCode'=>3001
            ));
        }else{
            $errcode=array_key_exists('errcode',$result);
            if($errcode){
                throw new WxException(array(
                    'errorCode'=>'3002'
                ));
            }else{
                return $this->grantToken($result);
            }
        }
    }


    public function grantToken($result){
        $openid=$result['openid'];
        $user=UserModel::where(['openid'=>$openid])->find();
        if(!$user){
            $user=UserModel::create(['openid'=>$openid]);
        }
        $uid=$user->id;
        $result=$this->prepareValue($result,$uid);
        $token = $this->saveToCache($result);
        return $token;
    }


    protected function prepareValue($result,$uid){
        $result['uid']=$uid;
        return $result;
    }

    protected function saveToCache($result){
        $key=self::createToken();
        $value=Cache::set($key,json_encode($result),config('api.token_expire_in'));
        if(!$value){
            throw new TokenException(array('errorCode'=>2001));
        }
        return $key;
    }
}