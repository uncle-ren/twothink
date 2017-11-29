<?php
namespace app\home\controller;


class  User extends Home
{
    Public function my(){
        //判断是否已经登录
        if(is_login()){
            //成立则已经登录
            echo 1;
        }else{
            //不成立则跳转到登录界面
            $this->redirect('login');
        }
    }


    public  function login(){
        //echo 1; die;
        return $this->fetch('online');
    }



}