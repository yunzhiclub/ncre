<?php
/**
 * 授权认证
 */
namespace app\wechat\controller;
use think\Request;
use think\Session;
use think\Url;
use EasyWeChat\Foundation\Application;


class OAuthController extends WechatController {
    protected $app;                     // 微信根对象
    public function __construct() {
        parent::__construct();
        $config = $this->config;

        // 设置回调函数
        $config['oauth']['callback'] = Url::build('getUserAndSession');
        $this->app = new Application($config);
    }

    /**
     * 授权认证入口
     * @return   303                   跳转至微信官方服务器认证界面
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-21T07:51:33+0800
     */
    public function index() {
        if (is_null(Session::get('wechat_user'))) {
            $callbackUrl = Request::instance()->param('callbackurl');
            session('callbackUrl', $callbackUrl);
            return $this->app->oauth->redirect();
        } else {
            return $this->redirectToCallbackUrl();
        }
    }

    /**
     * 获取用户的数据，并进行session存储
     * @return   [type]                   [description]
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-21T08:10:59+0800
     */
    public function getUserAndSession() {
        // 获取 OAuth 授权结果用户信息
        $user = $this->app->oauth->user(); 
        Session::set('wechat_user', $user);
        return $this->redirectToCallbackUrl();
    }

    /**
     * 跳转回用户传入的地址   
     * @return   303
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-21T07:53:57+0800
     */
    private function redirectToCallbackUrl() {
        $user = Session::get('wechat_user');
        $callbackUrl = Session::get('callbackUrl') . '?openid=' . $user['openid'];
        return $this->redirect($callbackUrl);
    }
}