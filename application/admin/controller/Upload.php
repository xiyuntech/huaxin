<?php
namespace app\admin\controller;
class Upload extends Base{
    public function _initialize()
    {

    }

    public function img(){
        $file = request()->file('img');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $savePath=str_replace('\\','/',$info->getSaveName());
                return json(success('上传成功',['path'=>$savePath]));
            }else{
                return json(fail('上传失败'));

            }
        }
    }
}