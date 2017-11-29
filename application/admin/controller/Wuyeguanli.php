<?php

namespace app\admin\controller;

use app\admin\model\Repairs;
use think\Db;
use think\Request;

class Wuyeguanli extends Admin{

    Public function listwuye(

    ){
        $list = Db::name('repairs')->paginate(2,true);
        //$list = User::where('status',1)- >paginate(10,true);
        $page = $list->render();

        $this->assign('_list', $list);
        $this->assign('page', $page);
        $this->assign('meta_title','报修管理');

        return $this->fetch('listwuye');
    }

    Public function add(){
        //$request= new  Request();
        $this->assign('meta_title','新增报修');
        $this->assign('data',null);
        return $this->fetch('add');
    }

    Public function save(){
        //var_dump(1);die;
        $a=new Repairs();
        $nickname = input('name');
        $tel = input('tel');
        $address = input('address');
        $title = input('title');
        empty($nickname) && $this->error('用户名不能为空');
        empty($tel) && $this->error('电话号码不能为空');
        empty($address) && $this->error('地址不能为空');
        empty($title) && $this->error('问题不能为空');
        $_POST["status"]=0;

        $a->save($_POST);
        //echo "添加成功";die;
        $this->success('报修订单添加成功！',url('listwuye'));
            //return true;


    }
    Public function del($id){
        $a= Db::table("repairs")->where(["id"=>$id]);
        $a->delete();
        $this->success('报修订单成功！',url('listwuye'));
       // return  var_dump($a);
    }
    Public function edit($id){
        $list= Db::table("repairs")->where(["id"=>$id])->find($id);
        /*if(\request()->isPost()){
            //如果是保存
            var_dump($_POST);die;
            if($list->save($_POST)){
                $this->success('报修订单修改成功！',url('listwuye'));
                return true;
            }else{
                return false;
            }
           die;
        }*/
        //var_dump($list);die;
        $this->assign('data',$list);
        $this->assign('meta_title', '修改报修');
        return $this->fetch('edit');

    }
    Public function saveedit(){
        $list= Db::table("repairs")->where(["id"=>$_POST["id"]])->find();
    //return var_dump($list);
        $_POST["time"]=time();
        $_POST["status"]=0;
        $a=new Repairs();
        $a->update($_POST);
        $this->success('报修订单添加成功！',url('listwuye'));
    }

}
