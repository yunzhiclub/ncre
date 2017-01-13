<?php
namespace app\model;
use think\Db;
use app\model\TicketsModel;     // 准考证信息表
/**
* 连接sql server数据库
*/
class TestroomModel extends ModelModel
{
    protected $connection = [
        // 数据库类型
        'type'        => 'Sqlsrv',
        // 数据库连接DSN配置
        'dsn'         => '',
        // 服务器地址
        'hostname'    => '192.168.0.143',
        // 数据库名
        'database'    => 'EMS',
        // 数据库用户名
        'username'    => 'sa',
        // 数据库密码
        'password'    => 'sa',
        // 数据库连接端口
        'hostport'    => '',
        // 数据库连接参数
        'params'      => [],
        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
        'prefix'      => 'dbo.',
    ];

    /**
     * [getAddressByKch 通过考场号获取考场名称]
     * @Author   litian,                  1181551049@qq.com
     * @DateTime 2017-01-05T15:01:38+0800
     * @param    [string]                   [考场号]
     * @return   [array]                   [考场名称]
     */
    static public function getAddressByExmRoomNums($exmroomnums='')
    {
        // 初始化数组
        $map = [];
        $addresses = [];

        foreach ($exmroomnums as $exmroomnum) {
            $map['code'] = $exmroomnum;
            // 根据考场号获取考场名称
            $addresses[] = TestroomModel::get($map)->getData('ADDRESS');
        }
        return $addresses;
    }
    /**
     * [getKchByIdCardNum 根据身份证号获取考场号]
     * @Author   litian,                  1181551049@qq.com
     * @DateTime 2017-01-05T15:16:42+0800
     * @param    [string]                   $idcardnum        [身份证号]
     * @return   [array]                                     [考场号]
     */
    static public function getExmRoomNumsByIdCardNum($idcardnum)
    {
        // 根据身份证号获取到准考证数组
        $Tickets = TicketsModel::getTicketByIdCardNum($idcardnum);
        $exmroomnums = [];
        foreach ($Tickets as $Ticket) {
            $exmroomnums[] = $Ticket->getData('kch');
        }
        return $exmroomnums;
    }
}
