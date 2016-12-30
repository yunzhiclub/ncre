<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;
use app\model\ScoreModel;
use app\model\TestRoomModel;
class IndexController extends Controller
{
    // 文件上传提交并读取
    public function upload(Request $request)
    {
        // 文件上传
        // 获取表单上传文件
        $file = $request->file('file');
        
        if (empty($file)) {
            $this->error('请选择上传文件');
        }
        // 移动到框架应用目录/runtime/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'runtime' . DS . 'uploads');
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
        $TestRoomModel = new TestRoomModel;

        //dbase数据库的地址和文件名
        $dbf= RUNTIME_PATH.'uploads'. DS . $title;
        $db=dbase_open($dbf,0) or die ("Can not connect to the *.dbf file!");
        $lists= [];
        $list = [];
        if ($db) {
            //读取dbase数据库的行数
            $record_numbers = dbase_numrecords($db);
            //依次读取每一行数据
            for ($i = 1; $i <= $record_numbers; $i++) {
                $row = dbase_get_record_with_names($db, $i);
                $keys = ['ZJH', 'ZKZH', 'KCH', 'PCH'];
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
            // 清空数据表
            $result = Db::execute('TRUNCATE table yunzhi_test_room');
            // 成绩则存储$ScoreModel
            if ($TestRoomModel->saveAll($lists)) {
                return "批量保存成功";
            }else{
                return $TestRoomModel->getError();
            }
            dbase_close($db);
        }
    }

    public function index()
    {
        return $this->fetch();
    }
}
