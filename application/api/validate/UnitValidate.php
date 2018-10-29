<?php


namespace app\api\validate;
use app\lib\exception\ParamsException;
class UnitValidate extends BaseValidate{
    public $errorCode=4001;
    public function goCheck(){
        $param=input('param.');
        if(!$this->check($param)){
            throw new ParamsException(array('errorCode'=>$this->errorCode,'msg'=>is_array($this->error)?implode(',',$this->error):$this->error));
        }
        return $param;
    }
    protected $rule=[
        'name'=>'require|max:50',
        'phone'=>'require|checkPhone',
        'company_name'=>'require|max:100',
        'address'=>'require|max:150',
        'id'=>'require|integer'
    ];


    protected $message=[
        'name.require'=>'请填写联系人的姓名',
        'name.max'=>'名字太长了，是不是写错了',
        'phone.require'=>'请填写联系人的手机',
        'phone.checkPhone'=>'手机号格式不正确',
        'company_name.require'=>'请填写公司名称',
        'company_name.max'=>'公司名称太长了',
        'address.require'=>'请填写公司地址',
        'address.max'=>'地址太长了',
        'id.require'=>'缺少主键信息',
        'id.integer'=>'主键格式不正确'
    ];

    protected $scene=[
        'create'=>['name','phone','company_name','address'],
        'update'=>['name','phone','company_name','address','id']
    ];

}