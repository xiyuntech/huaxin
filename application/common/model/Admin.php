<?php



namespace app\common\model;


class Admin extends Base{

    public static function add($post){
        try{
            $admin=self::where('status','<>',-1)->where(['username'=>$post['username']])->find();
            if($admin){
                return fail('用户名已经存在');
            }
            $post['password']=md5($post['password']);
            self::create($post,true);
            return success('添加数据成功',[],url(strtolower(request()->controller()).'/index'));
        }catch(\Exception $e){
            return fail($e->getMessage());
        }
    }


    public static function edit($post){
        $id=isset($post['id'])?$post['id']:0;
        $model=self::where('status','<>','-1')->where('id','=',$id)->find();
        if(!$model){
            return fail('主键信息不正确');
        }
        try{
            $admin=self::where('status','<>',-1)->where(['username'=>$post['username']])->find();
            if($admin&&$admin->id!=$post['id']){
                return fail('用户名已经存在');
            }
            $post['password']=md5($post['password']);
            $model->allowField(true)->save($post);
            return success('修改数据成功',[],url(strtolower(request()->controller()).'/index'));
        }catch(\Exception $e){
            return fail($e->getMessage());
        }

    }


    public static function LoginIn($data){
        $username=isset($data['username'])?$data['username']:'';
        $password=isset($data['password'])?$data['password']:'';
        $user=self::where('status','<>',-1)->where(['username'=>$username])->find();
        if(!$user){
            return fail('用户名不存在');
        }
        if($user->status==0){
            return fail('账号被禁用了 ，请联系超级管理员');
        }
        if(md5($password)!==$user->password){
            return fail('用户名或者密码错误');
        }
        self::saveInfoToSession($user);
        self::updateInfo($user);
        return success('登录成功',[],url('index/index'));
    }


    protected static function saveInfoToSession($user){
        $res=['uid'=>$user->id,'username'=>$user->username];
        session('user',serialize($res),'admin');
    }

    protected static function updateInfo($user){
        try{
            $user->last_login_time=time();
            $user->last_login_ip=(ip2long(request()->ip()));
            $user->save();
            return true;
        }catch(\Exception $e){
            //可以记录日志
            return false;
        }
    }
}