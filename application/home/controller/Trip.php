<?php
namespace app\home\controller;




use think\Db;

class  Trip extends Home
{




    Public function listtrip(){
            //查询数据
        $lists = Db::table('document')->where(["category_id"=>45])->select();


        var_dump($lists);die;
        $this->assign('_list', $lists);
        return $this->fetch('notice');
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
        return $this->fetch('notice-detail');
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