<?php
namespace app\home\controller;


use app\admin\model\Notice;
use app\admin\model\Repairs;
use think\Db;

class  Shopactivity extends Home
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


    Public function listshop(){
            //查询数据
        $lists = Db::table('document')->where(["category_id"=>46,"status"=>"1"])->select();

        $this->assign('_list', $lists);
        return $this->fetch('notice');


    }

    Public function noticedetail($id){
        //根据id查找小区通知
       // var_dump(   time());
        $lists = Db::table('document')->where("id",$id)->select();
        //var_dump($lists);

        $this->assign('_list', $lists);
        return $this->fetch('notice-detail');
    }
    Public  function  xiaoquactivity(){
        echo "小区活动列表";
    }
    Public  function  shopactivity(){
        echo "商家活动列表";
    }
}