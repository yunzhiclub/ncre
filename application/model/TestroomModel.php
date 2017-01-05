<?php
namespace app\model;
use think\Db;
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
}
