<?php


namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\IdValidate;
use app\api\validate\PaginationValidate;
use app\common\model\Article as ArticleModel;
class Article extends BaseController{

    public function getArticles($page=1,$count=10){
        (new PaginationValidate())->goCheck();
        return ArticleModel::getArticles($page,$count);
    }


    public function getArticleDetail($id=''){
        (new IdValidate())->goCheck();
        return ArticleModel::getArticleDetail($id);
    }
}