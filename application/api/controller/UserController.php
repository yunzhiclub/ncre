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

        // 验证openid长度是否符合
        if (!UserModel::checkOpenidLength($openid)) {
            $this->response(20002);     // openid长度不正确
            return;
        }

        // 获取用户实体
        $UserModel = UserModel::getUserModelByOpenid($openid);
    }

    /**
     * 设置身份证号码
     * @param    integer                  $IdCardNum [description]
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-21T16:51:06+0800
     */
    public function setIDCardNum($IdCardNum = 0) {
        try {
            $idcardnum = Request::instance()->param('idcardnum');
            // 校验身份证号
            // 对UserModel的id_card_num赋值，并保存
            $UserModel->idcardnum = $idcardnum;
            $UserModel->save();
            // 成功设置，返回空数组
            return $this->response([]);

        } catch (\Exception $e) {
            $this->logException($e);
        }
    }

    /**
     * 设置是否接收推送消息
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-21T18:56:09+0800
     */
    public function setIsReceiveMessage($isReceiveMessage = 0) {
        try {

            $isReceiveMessage = Request::instance()->param('isReceiveMessage');
            $UserModel->UserModel = $isReceiveMessage;
            $UserModel->save();
            // 成功设置，返回空数组
            return $this->response([]);

        } catch (\Exception $e) {
            $this->logException($e);
        }
    }
}
