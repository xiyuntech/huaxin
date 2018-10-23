<?php

namespace app\admin\validate;

class Article extends Base{

    protected $rule=[
        'title'=>'require|max:100',
        'cover'=>'require|max:100',
        'content'=>'require',
        'id'=>'require|integer'
    ];


    protected $message=[
        'title.require'=>'请填写文章的标题',
        'title.max'=>'文章标题过长了',
        'cover.require'=>'请上传封面图',
        'cover.max'=>'上传出错了，请重试',
        'content.require'=>'请填写文章内容',
        'id.require'=>'缺少主键信息',
        'id.integer'=>'主键格式不正确'
    ];


    protected $scene=[
        'create'=>['title','cover','content'],
        'update'=>['title','cover','content','id'],
    ];
}