<?php

namespace app\admin\validate;

class Article extends Base{

    protected $rule=[
        'title'=>'require|unique:article|max:100',
        'cover'=>'require|max:100',
        'content'=>'require'
    ];


    protected $message=[
        'title.require'=>'请填写文章的标题',
        'title.unique'=>'该文章标题已经存在',
        'title.max'=>'文章标题过长了',
        'cover.require'=>'请上传封面图',
        'cover.max'=>'上传出错了，请重试',
        'content.require'=>'请填写文章内容'
    ];


    protected $scene=[
        'create'=>['title','cover','content']
    ];
}