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
    public   function savelogin(){
        $this->success('登录成功！',url('index/index'));
    }

    Public function regist(){
        //注册
        return $this->fetch('register');
    }
    Public function save(){

        //注册后的保存
       // var_dump($_POST);die;
        if($_POST["password"] != $_POST["repassword"]){
            $this->error('两次输入密码不一致');
        }
        //var_dump($_POST);die;
        unset($_POST["repassword"]);
        unset($_POST["verify"]);
        $this->save($_POST);

    }

}