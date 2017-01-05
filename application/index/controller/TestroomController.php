<?php
namespace app\index\controller;
use think\Controller;
use app\model\TestroomModel;    // sql server中的教室表
use app\model\TicketsModel;     // 准考证信息表
/**
* 
*/
class TestroomController extends Controller
{
    // 通过考场号获取考场名称
    public function getAddressByKch()
    {
        // 获取sql server中的testroom内容
        $TestroomModel = new TestroomModel;
        // 获取到考场号
        $kch = $this->getKchByIdCardNum('140602199012109044');
        $map['code'] = $kch;
        // 根据考场号获取考场名称
        $address = $TestroomModel::get($map)->ADDRESS;
        return $address;
    }
    // 根据身份证号获取kch
    public function getKchByIdCardNum($idcardnum)
    {
        $TicketsModel = new TicketsModel;

        $Ticket = $TicketsModel::getTicketsByIdCardNum($idcardnum);
        return $kch = $Ticket->kch;
    }
}
