<?php
namespace app\test\controller;
use think\Controller;
use app\model\TestroomModel;    // sql server中的教室表
use app\model\TicketsModel;     // 准考证信息表
use think\Config;       // 配置文件
use think\Request;
use think\Cookie;

use app\model\UserModel;
use app\model\SubjectModel;
use app\model\TestroomopenModel;
/**
* 测试获取考场号和获取考场名称信息
*/
class TestroomController extends Controller
{
    public function index()
    {
        // $ids = Request::instance()->param('ids');
        $ids = 'oiz0exKYnfbbIFRDHrJSOIUwNyUk';
        $UserModel = new UserModel;
        $User = $UserModel::getUserModelByOpenid($ids);
        // 获取身份证号
        $idcardnum = $User->getData('id_card_num');

        // 获取ticket
        $TicketsModel = new TicketsModel;
        $Tickets = $TicketsModel::getTicketByIdCardNum($idcardnum);
        $ticketNums = [];
        foreach ($Tickets as $Ticket) {
            $ticketNums[] = $Ticket['zkzh'];
        }
        var_dump($Tickets);

        // 获取testroom
        $TestroomModel = new TestroomModel;
        $exmroomnums = $TestroomModel::getExmRoomNumsByIdCardNum($idcardnum);
        $TestRooms = $TestroomModel::getTestRoomByExmRoomNums($exmroomnums);
        var_dump($TestRooms);

        // 获取subject
        $SubjectModel = new SubjectModel;
        $Subjects = $SubjectModel::getSubjectByTicketNum($ticketNums);
        var_dump($Subjects);

        // 获取testroomopen
        $TestroomopenModel = new TestroomopenModel;
        $Testroomopens = $TestroomopenModel::getTestRoomOpenByIdCardNum($idcardnum);
        var_dump($Testroomopens);

        // 返回数组
        $result = array();
        foreach ($Tickets as $key => $Ticket) {
            $result[$key]['userName'] = $Ticket['xm'];
            $result[$key]['address'] = $TestRooms[$key]['ADDRESS'];
            $result[$key]['exmTime'] = rtrim(rtrim($Testroomopens[$key]['BEGINTIME'], '0'), '.');
            $result[$key]['SubjectName'] = $Subjects[$key]['NAME'];
            $result[$key]['timeLong'] = $Subjects[$key]['TESTTIME2'];
        }
        var_dump($result);
    }
    public function index1()
    {
        $ids = 'oiz0exKYnfbbIFRDHrJSOIUwNyUk';
        $UserModel = new UserModel;
        $User = $UserModel::getUserModelByOpenid($ids);
        // 获取身份证号
        $idcardnum = $User->getData('id_card_num');

        $TestroomopenModel = new TestroomopenModel;
        $Testroomopens = $TestroomopenModel::getTestRoomOpenByIdCardNum($idcardnum);
    }
}
