<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;
use think\Config;       // 配置文件

use app\model\ScoreModel;       // 成绩表，生成成绩信息
use app\model\TicketsModel;     // 考场表，生成准考证信息
class IndexController extends Controller
{
    // 文件上传提交并读取
    public function upload(Request $request)
    {
        // 读取配置信息的uploads路径
        $uploads = Config::get('uploads');
        // 文件上传
        // 获取表单上传文件
        $file = $request->file('file');
        
        if (empty($file)) {
            $this->error('请选择上传文件');
        }
        // 移动到框架应用目录/runtime/uploads/ 目录下
        $info = $file->move($uploads);
        // 上传成功则保存文件名
        if ($info) {
            $title = $info->getSaveName();
        } else {
            // 上传失败获取错误信息
            $this->error($file->getError());
        }
        
        // 文件读取
        // 实例化score
        // $ScoreModel = new ScoreModel;
        // 实例化考场testroom
        $TicketsModel = new TicketsModel;

        //dbase数据库的地址和文件名
        $dbf= $uploads. DS . $title;
        $db=dbase_open($dbf,0) or die ("Can not connect to the *.dbf file!");

        // 初始化数组
        $lists= [];
        $list = [];
        if ($db) {
            //读取dbase数据库的行数
            $record_numbers = dbase_numrecords($db);
            //依次读取每一行数据
            for ($i = 1; $i <= $record_numbers; $i++) {
                $row = dbase_get_record_with_names($db, $i);
                $row['XM'] = trim(iconv('GBK','UTF-8',$row['XM']));
                $keys = ['XM', 'ZJH', 'ZKZH', 'KCH', 'PCH'];
                // $keys = ['ZJH', 'ZKZH', 'CJ', 'ZSBH'];
                foreach ($keys as $key) {
                    //检查是否存在$key
                    if (array_key_exists($key, $row)) {
                        $list[strtolower($key)] = $row[$key];
                    }
                }
                //合并数组
                array_push($lists, $list);

            }
            // 关闭文件
            dbase_close($db);
            // 清空数据表
            $yunzhi = Config::get('database.prefix');
            $result = Db::execute('TRUNCATE table ' .$yunzhi. 'tickets');
            // 成绩则存储$ScoreModel
            if ($TicketsModel->saveAll($lists)) {
                return $this->success("批量保存成功", 'index');
            }else{
                return $TicketsModel->getError();
            }
            
        }
    }

    public function index()
    {
        return $this->fetch();
    }
}
