<?php
namespace app\model;

/**
* 考场信息
*/
class TicketsModel extends ModelModel
{
    static public function getTicketsByIdCardNum($idcardnum)
    {
        $map['zjh'] = $idcardnum;
        $Tickets = TicketsModel::get($map);
        return $Tickets;
    }
}
