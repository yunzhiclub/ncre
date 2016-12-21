<?php
namespace app\test\controller;
use app\wechat\service\UserService;
/**
 * 测试UserService, 由于TP的单元测试支持的并不好，只能采取写在C层的方法
 */
class UserServiceController {
    public function getUserByOpenid() {
        $UserService = new UserService;
        var_dump($UserService->getUserByOpenid('oOwB6sy8xNewilVlHzTWh9nf_RFo'));
    }
}