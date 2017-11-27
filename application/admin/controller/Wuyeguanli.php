<?php

namespace app\admin\controller;

use app\admin\model\Repairs;
use think\Db;
use think\Request;

class Wuyeguanli extends Admin{

    Public function listwuye(){
       $a= Db::table("repairs")->find();

        //var_dump($a);die;
        $name       =   input('nickname');
//        $map['status']  =   array('eq',0);
        if(is_numeric($name)){
            $map['uid|name']=   array('like','%'.$name.'%');
        }else{
            $map['name']    =   array('like', '%'.(string)$name.'%');
        }

        $list   = $this->lists('Repairs', $map);
        int_to_string($list);
        $this->assign('_list', $list);
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
        $a= new Repairs();

        $a->save($_POST);
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
        if(\request()->isPost()){
            //如果是保存
            var_dump($_POST);die;
            if($list->save($_POST)){
                $this->success('报修订单修改成功！',url('listwuye'));
                return true;
            }else{
                return false;
            }
           die;
        }
        //var_dump($list);die;
        $this->assign('data',$list);
        $this->assign('meta_title', '修改报修');
        return $this->fetch('edit');

    }
    Public function saveedit(){
        $list= Db::table("repairs")->where(["id"=>$_POST["id"]])->find();
    //return var_dump($list);
        $_POST["time"]=time();

    }

}
