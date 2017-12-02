<?php
namespace app\home\controller;


class  User extends Home
{
    Public function my(){
        //判断是否已经登录
        if(is_login()){
            //成立则已经登录
           echo  "这是个人中心!!　　　　　　";

           echo "<a href='/user/login/logout'>注销</a>";
        }else{
            //不成立则跳转到登录界面
            $this->redirect('login');
        }
    }


    public  function login(){


        return $this-$this->redirect('/user/login/index');
        //return $this->fetch('online');
    }

    Public function test(){

    }

}