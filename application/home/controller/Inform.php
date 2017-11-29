<?php
namespace app\home\controller;


use app\admin\model\Repairs;

class  Inform extends Home
{

    Public function online()
    {
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
        $address = input('address');
        $title = input('title');
        empty($nickname) && $this->error('姓名不能为空');
        empty($tel) && $this->error('电话号码不能为空');
        empty($address) && $this->error('地址不能为空');
        empty($title) && $this->error('问题不能为空');
        $_POST["status"] = 0;

        $a->save($_POST);
        //echo "成功";
        $this->success('报修订单添加成功！', url('listwuye'));
        //return true;


    }



}