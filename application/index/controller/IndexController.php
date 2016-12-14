<?php
namespace app\index\controller;

use think\Controller;
class IndexController extends Controller
{
    public function index()
    {
        //dbase数据库的地址和文件名
        $dbf="score.dbf";
        $db=dbase_open($dbf,0) or die ("Can not connect to the *.dbf file!");
        if ($db) {
            //读取dbase数据库的行数
            $record_numbers = dbase_numrecords($db);
            //依次读取每一行数据
            for ($i = 1; $i <= $record_numbers; $i++) {
                $row = dbase_get_record_with_names($db, $i);
                //处理数据...
                if ($i === 1) {
                    var_dump($row);
                }
                break;
            }
            // dbase_close($db);
            echo "读取成功";
        }
        return $this->fetch();
    }
    public function info()
    {
        phpinfo();
    }
}
