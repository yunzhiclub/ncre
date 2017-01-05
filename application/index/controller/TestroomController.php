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
    /**
     * [getAddressByKch 通过考场号获取考场名称]
     * @Author   litian,                  1181551049@qq.com
     * @DateTime 2017-01-05T15:01:38+0800
     * @return   [string]                   [考场名称]
     */
    public function getAddressByKch($kch=0)
    {
        // 获取到考场号
        $kch = $this->getKchByIdCardNum('140602199012109044');

        $map = [];
        $map['code'] = $kch;
        // 根据考场号获取考场名称
        $address = TestroomModel::get($map)->getData('ADDRESS');
        return $address;
    }
    /**
     * [getKchByIdCardNum 根据身份证号获取考场号]
     * @Author   litian,                  1181551049@qq.com
     * @DateTime 2017-01-05T15:16:42+0800
     * @param    [string]                   $idcardnum        [身份证号]
     * @return   [string]                                     [考场号]
     */
    public function getKchByIdCardNum($idcardnum)
    {
        $Ticket = TicketsModel::getTicketByIdCardNum($idcardnum);
        $kch = $Ticket->getData('kch');
        return $kch;
    }
}
