<?php
namespace app\home\controller;


use app\admin\model\Notice;
use app\admin\model\Repairs;
use think\Db;

class  Onlineweixiu extends Home
{

    Public function online()
    {
        //判断是否登录
        if(is_login()){
            //
            //echo "登录了";die;
            return $this->fetch('online');
        }else{
           //未登录先登录
            $this->success('请先登录','/user/login/index');
            //return $this-$this->redirect('/user/login/index');
        }


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


    Public function listnotice(){
            //查询数据
        $lists = Db::table('notice')->select();
        //var_dump($lists);die;
        $this->assign('_list', $lists);
        return $this->fetch('notice');
    }

    Public function noticedetail($id){
        //根据id查找小区通知
       // var_dump(   time());
        $lists = Db::table('notice')->where("id",$id)->select();
        //var_dump($lists);

        $this->assign('_list', $lists);
        return $this->fetch('notice-detail');
    }

}