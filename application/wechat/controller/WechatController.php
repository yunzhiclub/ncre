<?php
namespace app\wechat\controller;
use think\Config;
use think\Controller;
class WechatController extends Controller{
    protected $config;
    public function __construct() {
        $this->config = Config::get('wechat');
    }
}