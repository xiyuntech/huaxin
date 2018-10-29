<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


function success($message,$data=[],$next_url=''){
    return [
        'error'=>0,
        'message'=>$message,
        'data'=>$data,
        'next_url'=>$next_url
    ];
}

function fail($message,$data=[],$next_url=''){
    return [
        'error'=>1,
        'message'=>$message,
        'data'=>$data,
        'next_url'=>$next_url
    ];
}


function linkPage($pager){
    echo '<div style="margin-top:10px;float: right;margin-right: 10px;">'.$pager->render().'</div><div style="clear:both"></div>';
}


function curl_get($url, &$httpCode = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //不做证书校验,部署在linux环境下请改为true
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $file_contents = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $file_contents;
}

//生成订单号
function build_order_no()
{
    /* 选择一个随机的方案 */
    mt_srand((double) microtime() * 1000000);
    return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}