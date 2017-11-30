<?php
namespace app\home\controller;


use app\admin\model\Notice;
use app\admin\model\Repairs;
use think\Db;

class  Zushou extends Home
{
    Public function listzushou(){
            //查询数据
        $zu = Db::table('document')->where(["category_id"=>51,"status"=>1])->select();
        $shou = Db::table('document')->where(["category_id"=>52,"status"=>1])->select();

        $this->assign('_zu', $zu);
        $this->assign('_shou', $shou);
        return $this->fetch('zushou');
    }

    Public function noticedetail($id){
        //根据id查找小区通知
       // var_dump(   time());
        $lists = Db::table('document')->where("id",$id)->select();
        //var_dump($lists);
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