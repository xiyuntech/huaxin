<?php


namespace app\admin\validate;


class Train extends Base{

    protected $rule=[
        'name'=>'require|max:100',
        'picture'=>'require',
        'descr'=>'require',
        'content'=>'require',
        'price'=>'require|float',
        'begin_time'=>'require|checkFormat',
        'id'=>'require|integer'
    ];

    protected $message=[
        'name.require'=>'请填写培训名称',
        'name.max'=>'培训名称太长了',
        'descr.require'=>'请填写培训简介',
        'picture.require'=>'请上传培训封面图',
        'content.require'=>'请填写培训内容',
        'price.require'=>'请填写报名价格',
        'price.float'=>'报名价格格式不正确',
        'begin_time.require'=>'请选择开始时间',
        'begin_time.checkFormat'=>'开始时间格式不正确',
        'id.require'=>'缺少主键信息',
        'id.integer'=>'主键格式不正确'
    ];

    protected $scene=[
        'create'=>['name','picture','descr','content','price','begin_time'],
        'update'=>['name','picture','descr','content','price','begin_time','id']
    ];
    protected function checkFormat($value, $rule, $data){
        //格式是 YYYY-mm-dd HH:ii
        //前面的正则保证格式
        //后面的strtotime保证时间的正确性：例如:2018-22-36 15:22 执行strtotime返回false
        if(!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/',$value)||!strtotime($value)){
            return false;
        }
        return true;
    }
}