<?php


namespace app\api\service;

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
}