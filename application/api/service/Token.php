<?php


namespace app\api\service;

use app\lib\exception\TokenException;
use think\Cache;

class Token {


    //生成随机字符串
    public static function  getRangeString($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;
        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[mt_rand(0, $max)];
        }
        return $str;
    }

    //创建token
    public static function createToken(){
        $str=self::getRangeString(32);
        $timestamp=request()->server('REQUEST_TIME');
        $token=md5($str.$timestamp.config('api.slat'));
        return $token;
    }


    //获取缓存中的值
    public static function getTokenVar($key){
        $token=request()->header('token');
        $value=Cache::get($token);
        if(!$value){
            throw new TokenException(array('code'=>403));
        }
        $value=json_decode($value,true);
        if(array_key_exists($key,$value)){
            return $value[$key];
        }else{
            throw new TokenException(array('errorCode'=>2002));
        }
    }
}