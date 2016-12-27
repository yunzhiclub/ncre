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
        // 使用模型中的默认值进行初始化
        if (is_object($data)) {
            $data= get_object_vars($data);
        } else if (empty($data)) {
            $data = $this->data;            
        }

        parent::__construct($data);
    }

    /**
     * 对data进行赋值
     * @param    string                   $key   
     * @param                       $value 
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-12-27T16:42:24+0800
     */
    public function setData($name, $value)
    {
        // 标记字段更改
        if (!isset($this->data[$name]) || ($this->data[$name] != $value && !in_array($name, $this->change))) {
            $this->change[] = $name;
        }
        // 设置数据对象属性
        $this->data[$name] = $value;
        return $this;
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