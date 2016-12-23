<?php
namespace app\model;
use think\Model;
use think\Loader;

/**
 * 根类，用于方法的重写
 */
class ModelModel extends Model{

    /**
     * @overwrite 
     * @param    array                    $data 初始化的数据
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-22T10:23:31+0800
     */
    public function __construct($data = [])
    {
        if (is_object($data)) {
            $data= get_object_vars($data);
        } else {
            $data = $this->data;
        }
        parent::__construct($data);
    }


    public function toArray()
    {
        $item = [];

        //过滤属性
        if (!empty($this->visible)) {
            $data = array_intersect_key($this->data, array_flip($this->visible));
        } elseif (!empty($this->hidden)) {
            $data = array_diff_key($this->data, array_flip($this->hidden));
        } else {
            $data = $this->data;
        }

        foreach ($data as $key => $val) {
            $parseKey = Loader::parseName($key, 1);
            if ($val instanceof Model || $val instanceof Collection) {
                // 关联模型对象
                $item[$parseKey] = $val->toArray();
            } elseif (is_array($val) && reset($val) instanceof Model) {
                // 关联模型数据集
                $arr = [];
                foreach ($val as $k => $value) {
                    $arr[$k] = $value->toArray();
                }
                $item[$parseKey] = $arr;
            } else {
                // 模型属性
                $item[$parseKey] = $this->getAttr($key);
            }
        }
        // 追加属性（必须定义获取器）
        if (!empty($this->append)) {
            foreach ($this->append as $name) {
                $parseName = Loader::parseName($name, 1);
                $item[$parseName] = $this->getAttr($name);
            }
        }
        return !empty($item) ? $item : [];
    }
}