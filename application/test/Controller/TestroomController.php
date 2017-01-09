<?php
namespace app\test\controller;
use think\Controller;
use app\model\TestroomModel;    // sql server中的教室表
use app\model\TicketsModel;     // 准考证信息表
/**
* 测试获取考场号和获取考场名称信息
*/
class TestroomController extends Controller
{
    public function index()
    {
        $TestroomModel = new TestroomModel;
        // 获取到考场号
        $exmroomnums = $TestroomModel->getExmRoomNumsByIdCardNum('140602199012109044');
        // 获取到考场名称
        $address = $TestroomModel->getAddressByExmRoomNums($exmroomnums);
        var_dump($address);
    }
}
