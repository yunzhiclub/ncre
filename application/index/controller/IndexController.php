<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\model\UploadModel;
class IndexController extends Controller
{
    // 文件上传提交并读取
    public function upload(Request $request)
    {
        // 获取表单上传文件
        $files = $request->file('file');
        $item = [];

        foreach ($files as $file ) {
            // 移动到框架应用目录/runtime/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'runtime' . DS . 'uploads','');
            // 上传成功则保存文件名
            if ($info) {
                $item[] = $info->getRealPath();
            } else {
                // 上传失败获取错误信息
                $this->error($file->getError());
            }
        }
        return $this->success('文件上传成功'.implode('<br/>',$item));
    }

    public function read()
    {
        // 实例化score
        $ScoreModel = new ScoreModel;

        //dbase数据库的地址和文件名
        $dbf= RUNTIME_PATH.'uploads'. DS . "CJK4712.dbf";
        $db=dbase_open($dbf,0) or die ("Can not connect to the *.dbf file!");

        if ($db) {
            //读取dbase数据库的行数
            $record_numbers = dbase_numrecords($db);
            //依次读取每一行数据
            for ($i = 1; $i <= $record_numbers; $i++) {
                $row = dbase_get_record_with_names($db, $i);
                //当存在准考证号键时 合并数组
                if (array_key_exists('ZKZH', $row)) {
                    $lists= [];
                    array_push($lists, $row);
                    // return $lists;
                }
                if ($i === 4) {
                    var_dump($lists);
                    break;
                }
            }

            // 将数组循环存储全部
            foreach ($lists as $list) {
                if ($ScoreModel->saveAll($list)) {
                    return "批量保存成功";
                }else{
                    return $ScoreModel->getError();
                }
            }
            dbase_close($db);
        }
    }

    public function index()
    {
        return $this->fetch();
    }
}
