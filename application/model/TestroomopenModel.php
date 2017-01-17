<?php
namespace app\model;
use think\Db;
use app\model\TestroomModel;     // 考场信息表
use app\model\TicketsModel;      // 准考证信息表
/**
* 连接sql server数据库
*/
class TestroomopenModel extends ModelModel
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
     * [getExmTimeByIdCardNum 通过准考证号和考场号获取考试时间]
     * @Author   litian,                  1181551049@qq.com
     * @DateTime 2017-01-13T14:20:16+0800
     * @param    [array]                   $ticketNums       [准考证号]
     * @return   [array]                                     [考场数组]
     */
    static function getTestRoomOpenByIdCardNum($idcardnum)
    {
        // 根据身份证信息获取tickersmodel
        $TicketsModel = new TicketsModel;
        $Tickets = TicketsModel::getTicketByIdCardNum($idcardnum);
        foreach ($Tickets as $Ticket) {
            // 考场号和批次号
            $batche = $Ticket['pch'];
            $exmroomnum = $Ticket['kch'];
            $map = array('SEQ' => $batche, 'TR_CODE' => $exmroomnum);
            // 根据考场和批次号获取testroomModel
            $TestroomopenModels = TestroomopenModel::all($map);
            foreach ($TestroomopenModels as $TestroomopenModel) {
                $Testroomopens[] = $TestroomopenModel->getData();
            }
        }
        return $Testroomopens;
    }
}
