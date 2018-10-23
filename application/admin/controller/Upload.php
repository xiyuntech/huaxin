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


    public function editorUpload(){
        $file = request()->file('editor');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $savePath=str_replace('\\','/',$info->getSaveName());
                return json(['errno'=>0,'data'=>['/uploads/'.$savePath]]);
            }else{
                return json(['errno'=>1,'message'=>'上传图片失败，请重试']);

            }
        }
    }
}