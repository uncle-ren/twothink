<?php

namespace app\home\controller;
use think\Controller;
use think\Session;

class Wendor extends Controller
{
    public function index(){
        //保存当前地址到session
        Session::set('returl_url',url('home/wendor/index'));

        if(!Session::has('openid')){
            $appid="wx8b6b09d360e473e8";
            //$redirect_uri = url('home/wendor/callback','',true,true);//设置绝对路径
            $callback_url=url('home/wendor/callback','',true,true);
            //第一步：用户同意授权，获取code
            //引导关注者打开如下页面：
            //   https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
            $url="https://open.weixin.qq.com/connect/oauth2/authorize?".
                "appid={$appid}&redirect_uri={$callback_url}&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
            $this->redirect($url);
        }else{
            $openid=Session::get('openid');

        }

    }
    //授权成功回调页
    public function callback(){
        //获取code
        $appid="wx8b6b09d360e473e8";
        $secret="0db35d805a909bb23f1860aa183f0e0e";
        $code=request()->get("code");

        //通过code换区网页授权access_token
        //请求 https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?".
            "appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
        $str=file_get_contents($url);
        $json=json_decode($str);
        //保存openid 到session
        Session::set('openid',$json->openid);
        if(Session::has('returl_url')){
            $this->redirect(Session::get('return_url'));
        }
    }




}