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