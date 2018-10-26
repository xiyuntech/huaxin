<?php


namespace app\common\model;

class Article extends Base{

    protected $dateFormat=false;


    //获取最新文章
    public static function getArticles($page,$count){
        if($count>=20){
            $count=20;
        }
        $articles=self::where(['status'=>self::IS_SHOW])
            ->order(['create_time'=>'desc'])
            ->field('id,title,cover,create_time')
            ->limit(($page-1)*$count,$count)
            ->select();
        foreach($articles as $k=>$article){
            $articles[$k]['cover']=request()->domain().$article['cover'];
            $articles[$k]['create_time']=date('Y-m-d',$article['create_time']);
        }
        return $articles;
    }

    //获取文章详情
    public static function getArticleDetail($id){
        $article=self::where(['status'=>self::IS_SHOW])
            ->where(['id'=>$id])
            ->field('id,title,cover,create_time,content')
            ->find();
        if(!$article){
            return [];
        }
        $article['cover']=request()->domain().$article['cover'];
        $article['create_time']=date('Y-m-d',$article['create_time']);
        return $article;
    }
}