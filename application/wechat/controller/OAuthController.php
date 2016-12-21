<?php
namespace app\wechat\controller;
use think\Request;
use think\Session;
use think\Url;
use EasyWeChat\Foundation\Application;

class OAuthController extends WechatController {
    protected $app;
    public function __construct() {
        parent::__construct();
        $config = $this->config;
        $config['oauth']['callback'] = Url::build('getUserAndSession');
        $this->app = new Application($config);
    }

    public function index() {
        Session::set('wechat_user', null);
        if (is_null(Session::get('wechat_user'))) {
            $callbackUrl = Request::instance()->param('callbackurl');
            session('callbackUrl', $callbackUrl);
            return $this->app->oauth->redirect();
        }

    }

    public function getUserAndSession() {
        // 获取 OAuth 授权结果用户信息
        // $user = $this->app->oauth->user(); 
        // Session::set('wechat_user', $user);
        // $callbackUrl = Session::get('callbackUrl') . '?openid=' . $user['openid'];
        $callbackUrl = Session::get('callbackUrl') . '?openid=' . '123213';
        var_dump($callbackUrl);
        return;
        return $this->redirect($callbackUrl);
    }
}