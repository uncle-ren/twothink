<?php
namespace app\home\controller;


use app\admin\model\Notice;
use app\admin\model\Repairs;
use think\Db;

class  Fuwu extends Home
{
    Public function listmenu(){
            //查询数据
        return  $this->fetch('fuwu');
    }

    Public function noticedetail($id){
        //根据id查找小区通知

        $lists = Db::table('document')->where("id",$id)->select();

        $photo=Db::table('document_article')->where("id",$id)->select();
        $this->assign('_list', $lists);
        $this->assign('photo', $photo);
        //var_dump($photo);die;
        return $this->fetch('zushou-detail');
    }
    public function Ajax(){

        $communs=Db::table('document')->where('category_id',45)->where('status',1)->paginate(2);
        // var_dump($commun);die;
        //return var_dump($commun);die;
        $a=[];
        foreach ($communs as  $commun){
            $commun["deadline"]=date("Y-m-d H:i:s",$commun["deadline"]);
            $a[]=$commun;
        }
        return $a;

    }
}