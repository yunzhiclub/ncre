<?php
namespace app\model;

/**
* 准考证信息表
*/
class TicketsModel extends ModelModel
{
    // 通过身份证号获取Tickets对象
    static public function getTicketsByIdCardNum($idcardnum)
    {
        $map['zjh'] = $idcardnum;
        $Tickets = TicketsModel::get($map);
        return $Tickets;
    }
}
