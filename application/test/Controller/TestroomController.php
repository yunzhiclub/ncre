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
        $ids = 'oiz0exAmEEq7SBIjy84XzQ5AO7SA';
        $UserModel = new UserModel;
        $User = $UserModel::getUserModelByOpenid($ids);
        // 获取身份证号
        $idcardnum = $User->getData('id_card_num');

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
            ['userName' => $userName],
            ['SubjectName' => $SubjectNames],
            ['ticketNum' => $ticketNums],
            ['addresses' => $addresses],
            ['exmTime' => $exmTimes],
            ['timeLongs' => $timeLongs]
        ];
        // array_push($data,$exmroomnums,$addresses);
        var_dump($data);
    }
}
