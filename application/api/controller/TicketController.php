<?php
namespace app\api\controller;
use think\Request;
use app\model\UserModel;
use think\Cookie;
/**
 * 考场编排信息
 */
class TicketController extends ApiController {
    /**
     * 通过openid获取考生的考场编排信息
     * @param    array [int]                 $ids
     * @return                              array
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-23T10:32:00+0800
     */
    public function getTicketsByIds() {
        $ids = Request::instance()->param('ids');
        // 以下请由数据表中抓取数据，并反馈给前台。
        // 示例返回数据如下：
        $data = [
            ['userName' => '张三'],
            ['userName' => '还是张三']
        ];
        return $this->response($data);
    }
}