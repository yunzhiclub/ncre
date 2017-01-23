<?php
namespace app\model;
use think\Db;
use app\model\TicketsModel;     // 准考证信息表
/**
* 连接sql server数据库
*/
class SubjectModel extends ModelModel
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
     * [getSubjectByTicketNum 通过准考证号获取考试科目名称]
     * @Author   litian,                  1181551049@qq.com
     * @DateTime 2017-01-13T14:20:16+0800
     * @param    [array]                   $ticketNums       [准考证号]
     * @return   [array]                                     [科目数组]
     */
    static function getSubjectByTicketNum($ticketNums)
    {
        $SubjectModel = new SubjectModel;
        $Subjects = [];
        foreach ($ticketNums as $ticketNum) {
            $code['code'] = substr($ticketNum, 0, 2);
            $Subjects[] = $SubjectModel::get($code)->getData();
        }
        
        return $Subjects;
    }
}
