<?php
namespace app\home\controller;


use app\admin\model\Notice;
use app\admin\model\Repairs;
use think\Db;

class  Yezhurenzheng extends Home
{
    Public function listrenzheng(){
        //如果未登录 则提示登录
        if(1){
            //成立则已经登录
            if(1){
                //成立则未认证
                //echo 112 ;die;
                return $this->fetch('yezhurenzheng');
            }else{

            }

        }else{
            //不成立则跳转到登录界面

            $this->redirect('/user/login/index');
        }
    }

    Public function saveform(){
        $a=new \app\admin\model\Yezhurenzheng();
        $nickname = input('name');
        $room = input('room');
        $tel = input('guanxi');
        $address = input('tel');
        $title = input('idnum');
        empty($nickname) && $this->error('用户名不能为空');
        empty($room) && $this->error('房号不能为空');

        empty($address) && $this->error('联系电话不能为空');
        empty($title) && $this->error('身份证不能为空');
        $a->save($_POST);
        $this->success('报修订单添加成功！', '/home/index/index');
    }

}