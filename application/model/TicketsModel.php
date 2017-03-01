<?php
namespace app\model;

/**
* 准考证信息表
*/
class TicketsModel extends ModelModel
{
    /**
     * [getTicketByIdCardNum 通过身份证号获取Tickets对象]
     * @Author   litian,                  1181551049@qq.com
     * @DateTime 2017-01-05T15:04:48+0800
     * @param    [string]                   $idcardnum        [身份证号]
     * @return   [array]                                     [Ticket数组]
     */
    static public function getTicketByIdCardNum($idcardnum)
    {
        $map = [];
        $Tickets = [];
        $map['zjh'] = $idcardnum;
        $TicketModels = TicketsModel::all($map);
        foreach ($TicketModels as $TicketModel) {
            $Tickets[] = $TicketModel->getData();
        }
        return $Tickets;
    }
}
