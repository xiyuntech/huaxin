<?php


namespace app\admin\validate;

class Info extends Base{

    protected $rule=[
        'company_name'=>'require',
        'logo'=>'require',
        'concat_phone'=>'require',
        'introduce'=>'require',
        'receive_name'=>'require',
        'open_name'=>'require',
        'receive_account'=>'require'
    ];


    protected $message=[
        'company_name'=>'请填写公司名称',
        'logo'=>'请上传公司logo',
        'concat_phone'=>'请填写公司介绍',
        'receive_name'=>'请填写收款单位名称',
        'open_name'=>'请填写账号开户行',
        'receive_account'=>'请填写收款账号',
        'introduce'=>'请填写公司介绍'
    ];


    protected $scene=[
        'update'=>['company_name','logo','concat_phone','introduce','receive_name','open_name','receive_account'],
    ];
}