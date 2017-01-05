<?php
namespace app\index\controller;
use think\Controller;
use app\model\TestroomModel;
use app\model\TicketsModel;
/**
* 
*/
class TestroomController extends Controller
{
    
    public function getAddressByKch()
    {
        // 获取sql server中的testroom内容
        $TestroomModel = new TestroomModel;

        // 根据身份证号获取Tickets对象
        $TicketsModel = new TicketsModel;
        $Ticket = $TicketsModel::getTicketsByIdCardNum('140602199012109044');

        $kch = $Ticket->kch;
        $map['code'] = $kch;
        // 获取地址
        $address = $TestroomModel::get($map)->ADDRESS;
        return $address;
    }
}
