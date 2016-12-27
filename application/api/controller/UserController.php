<?php
namespace app\api\controller;
use think\Request;
use app\model\UserModel;

class UserController extends ApiController {
    private $UserModel;

    public function __construct(Request $request = null) {
        parent::__construct($request);

        // 获取用户传入的openid
        $openid = Request::instance()->param('openid');
        //$openid = 'oiz0exAmEEq7SBIjy84XzQ5AO7SB';

        // 验证openid长度是否符合
        if (!UserModel::checkOpenidLength($openid)) {
            $this->response(20002);     // openid长度不正确
            return;
        }

        // 获取用户实体
        $this->UserModel = UserModel::getUserModelByOpenid($openid);
    }

    /**
     * 设置身份证号码
     * @param    integer                  $idCardNum [description]
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-21T16:51:06+0800
     */
    public function setIDCardNumByOpenid($idCardNum = 0, $openid = '') {
        try {
            // 获取用户实体
            $UserModel = UserModel::getUserModelByOpenid($openid);

            // 设置身份证号
            $UserModel->setData('id_card_num', $idCardNum);

            // 更新数据并进行验证
            if (false === $UserModel->save()) {
                return $this->response(20004, $UserModel->getError());
            } else {
                return $this->response();
            }

        } catch (\Exception $e) {
            $this->exception($e);
        }
    }

    /**
     * 设置是否接收推送消息
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-21T18:56:09+0800
     */
    public function setIsReceiveMessageByOpenid($isReceiveMessage = 0) {
        try {
            //$openid = 'oiz0exAmEEq7SBIjy84XzQ5AO7SB';
            $User = $this->UserModel->getData('is_receive_message');
            //检验是否接收推送消息            
            if (!($User)) {
                //对UserModel的is_receive_message赋值，并保存
                $isReceiveMessage = true;
                $this->UserModel->is_receive_message = $isReceiveMessage;
                $this->UserModel->save();
            } else {
                //返回之前保存过的值
                $new_UserModel = $this->UserModel; 
                return $new_UserModel;
            }
            
            // 成功设置，返回空数组
            return $this->response($this->UserModel);

        } catch (\Exception $e) {
            $this->exception($e);
        }
    }


    /**
     * 获取用户基本信息
     * @return   [type]                   [description]
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-22T10:13:54+0800
     */
    public function getUserByOpenid($openid) {
        try {
            // 获取用户实体
            $UserModel = $this->UserModel;
            
            // 成功设置，返回空数组
            return $this->response($UserModel);

        } catch (\Exception $e) {
            $this->exception($e);
        }
    }
}
