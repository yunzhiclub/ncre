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

        // 获取学生姓名\准考证号\批次号
        $TicketsModel = new TicketsModel;
        $Tickets = $TicketsModel::getTicketByIdCardNum($idcardnum);
        $userName = [];
        $ticketNums = [];
        foreach ($Tickets as $Ticket) {
            $userName[] = $Ticket['xm'];
            $ticketNums[] = $Ticket['zkzh'];
        }

        // 获取考试地点
        $TestroomModel = new TestroomModel;
        $exmroomnums = $TestroomModel::getExmRoomNumsByIdCardNum($idcardnum);
        $addresses = $TestroomModel::getAddressByExmRoomNums($exmroomnums);
        // 获取考试科目
        $SubjectModel = new SubjectModel;
        $Subjects = $SubjectModel::getSubjectByTicketNum($ticketNums);
        $SubjectNames = [];
        $timeLongs = [];
        foreach ($Subjects as $Subject) {
            $SubjectNames[] = $Subject->getData('NAME');
            $timeLongs[] = $Subject->getData('TESTTIME2');
        }
        // 获取考试时间
        $TestroomopenModel = new TestroomopenModel;
        $exmTimes = $TestroomopenModel::getExmTimeByIdCardNum($idcardnum);
        // 示例返回数据如下：
        $data = [
            'userName' => $userName,
            ['SubjectName' => $SubjectNames],
            ['ticketNum' => $ticketNums],
            ['addresses' => $addresses],
            ['exmTime' => $exmTimes],
            ['timeLongs' => $timeLongs]
        ];
        return $this->response($data);
    }
}
