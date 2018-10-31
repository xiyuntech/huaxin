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
}