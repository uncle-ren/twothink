<?php
namespace app\home\controller;


use app\admin\model\Notice;
use app\admin\model\Repairs;
use think\Db;

class  About extends Home
{

    Public function about(){
            //查询数据
        $lists = Db::table('document')->where("category_id",48)->select();
        $photo=Db::table('document_article')->where("id",142)->select();
        $this->assign('_list', $lists);
        $this->assign('content', $photo);
        return $this->fetch('notice');
    }



}