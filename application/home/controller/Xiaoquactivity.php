<?php
namespace app\home\controller;


use app\admin\model\Notice;
use app\admin\model\Repairs;
use think\Db;

class  Xiaoquactivity extends Home
{

    Public function online()
    {
        request()->get();
        //echo 1;die;
        //在线提交订单
        $repair = new Repairs();

        return $this->fetch('online');

    }

    Public function save()
    {

        $a = new Repairs();
        $nickname = input('name');
        $tel = input('tel');
        //$reg=/\w/;
        $address = input('address');
        $title = input('title');
        empty($nickname) && $this->error('姓名不能为空');
        empty($tel) && $this->error('电话号码不能为空');
        empty($address) && $this->error('地址不能为空');
        empty($title) && $this->error('问题不能为空');
        $_POST["status"] = 0;

        $a->save($_POST);
        //echo "成功";
        $this->success('报修订单添加成功！', 'index.html');
        //return true;


    }


    Public function listxiaoqu(){
            //查询数据
        $lists = Db::table('document')->where("category_id",45)->select();

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