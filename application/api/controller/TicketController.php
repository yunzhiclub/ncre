<?php
namespace app\api\controller;
use think\Request;
use app\model\UserModel;
use think\Cookie;
use app\model\TestroomModel;    // 连接sql server中的考场信息
use app\model\SubjectModel;     // 连接sql server中的学科表
use app\model\TestroomopenModel;// 连接sql server中的考场详情表
use app\model\TicketsModel;     // 存的考场信息表
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
        // 输入的身份证号
        $idcardnum = $ids;

        // 获取ticket
        $TicketsModel = new TicketsModel;
        $Tickets = $TicketsModel::getTicketByIdCardNum($idcardnum);
        $ticketNums = [];
        foreach ($Tickets as $Ticket) {
            $ticketNums[] = $Ticket['zkzh'];
        }

        // 获取testroom
        $TestroomModel = new TestroomModel;
        $exmroomnums = $TestroomModel::getExmRoomNumsByIdCardNum($idcardnum);
        $TestRooms = $TestroomModel::getTestRoomByExmRoomNums($exmroomnums);

        // 获取subject
        $SubjectModel = new SubjectModel;
        $Subjects = $SubjectModel::getSubjectByTicketNum($ticketNums);

        // 获取testroomopen
        $TestroomopenModel = new TestroomopenModel;
        $Testroomopens = $TestroomopenModel::getTestRoomOpenByIdCardNum($idcardnum);

        // 返回数组
        $data = array();
        foreach ($Tickets as $key => $Ticket) {
            $data[$key]['userName'] = $Ticket['xm'];
            $data[$key]['ticketNum'] = $Ticket['zkzh'];
            $data[$key]['address'] = $TestRooms[$key]['ADDRESS'];
            $data[$key]['exmTime'] = rtrim(rtrim($Testroomopens[$key]['BEGINTIME'], '0'), '.');
            $data[$key]['SubjectName'] = $Subjects[$key]['NAME'];
            $data[$key]['timeLong'] = $Subjects[$key]['TESTTIME2'];
        }
        
        return $this->response($data);
    }
}
