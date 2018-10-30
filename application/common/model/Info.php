<?php


namespace app\common\model;


class Info extends Base{

    public static function addOrUpdateInfo($data){
        if(isset($data['id'])){
            //更新操作
            $id=$data['id'];
            $info=self::where(['status'=>1,'id'=>$id])->find();
            if(!$info){
                return fail('主键信息错误');
            }
            try{
                $info->allowField(true)->save($data);
                return success('修改信息成功');
            }catch(\Exception $e){
                return fail($e->getMessage());
            }
        }else{
            try{
                self::create($data,true);
                return success('修改信息成功');
            }catch(\Exception $e){
                return fail($e->getMessage());
            }
        }
    }


    public static function getAboutUs(){
        $info = self::where('status',1)
            ->field('company_name,address,introduce,concat_phone,logo')
            ->order(['create_time'=>'asc'])
            ->limit(0,1)
            ->find();
        $info['logo']=request()->domain().$info['logo'];
        return $info;
    }


    public static function getAccount(){
        $info = self::where('status',1)
            ->field('receive_name,open_name,receive_account')
            ->order(['create_time'=>'asc'])
            ->limit(0,1)
            ->find();
        return $info;
    }
}