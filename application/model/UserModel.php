<?php
/**
 * 用户模型
 */
namespace app\model;
use app\wechat\service\UserService;

class UserModel extends ModelModel {
    protected $data = [
        'openid' => 0,                      // openid
        'id_card_num' => '',                // 身份证号
        'is_receive_message' => false,      // 是否接收推送消息
    ];

    /**
     * 验证openid位数是否正确
     * @return   boolean true:正确 | false:错误
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-21T17:01:07+0800
     */
    static public function checkOpenidLength($openid = '') {
        // 较验openid的长度
        if (strlen($openid) === 28) {
            return true;   
        } else {
            return false;
        }
        
    }

    /**
     * 通过opendId获取用户的基本信息
     * @param    string                   $openid 
     * @return   UserModel                           
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-21T17:17:10+0800
     */
    static public function getUserModelByOpenid($openid = '') {
        // 查找数据库是否存在
        $UserModel = new UserModel;
        $map['openid'] = $openid;
        $User = $UserModel->where($map)->find();

        if (is_null($User)) {
            // 数据库中不存在，则调用app\wechat\service\UserService\getUserByOpenid;，获取用户的openid基本信息
            $UserService = new UserService;
            $user = $UserService->getUserByOpenid();
            // 将用户的openid信息存在数据表
            $User->openid = $user['openid'];
            // 用获取到的openid初始化对象，并返回
            $User->save();
            return $User;
        }else{
            // 数据库中存在，则返回获取到的对象
            return $User;
        }
         
    }

}
