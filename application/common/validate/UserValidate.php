<?php
namespace app\common\validate;

use think\Validate;		//验证类
class UserValidate extends validate
{
    protected $rule = [
        ['id_card_num', 'checkIDCardNumLength:15/18', '身份证格式错误，请重新输入'],
    ];

    protected function checkIDCardNumLength($IDCardNum) {
        //含有的字母字符转换为大写
        $IDCardNum = strtoupper($IDCardNum);

        //正则表达式验证15位和18位身份证号
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/"; 
        $arr_split = array(); 

        //检查输入的身份正号码是否和正则表达式相匹配
        if (!preg_match($regx, $IDCardNum)) { 
            return false; 
        } 

        //检查15位身份证号 
        if (15 == strlen($IDCardNum)) {
            //六位数字地址码，六位数字出生日期码，三位数字顺序码  
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";  
            @preg_match($regx, $IDCardNum, $arr_split); 

            //检查生日日期是否正确 
            $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4]; 
            //英文文本的日期时间描述解析为 Unix 时间戳
            if(!strtotime($dtm_birth)) { 
                return false; 
            } else { 
                return true; 
            } 
        } 
        //检查18位身份证号 
        else {
            //六位数字地址码，八位数字出生日期码，三位数字顺序码和一位数字校验码 
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/"; 
            @preg_match($regx, $IDCardNum, $arr_split); 

            //检查生日日期是否正确 
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];

            //英文文本的日期时间描述解析为 Unix 时间戳
            if (!strtotime($dtm_birth)) { 
                return false; 
            } else { 
                //检验18位身份证的校验码是否正确。 
                
                //计算身份证的最后一位验证码,校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。 
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); 
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'); 
                $sign = 0; 
                for ($i = 0; $i < 17; $i++) { 
                    $b = (int) $IDCardNum{$i}; 
                    $w = $arr_int[$i]; 
                    $sign += $b * $w; 
                } 
                $n = $sign % 11; 
                $val_num = $arr_ch[$n];

                //检验输入的身份证号最后一位是否和所计算的验证码一致
                if ($val_num != substr($IDCardNum,17, 1)) { 
                    return false; 
                } else { 
                    return true; 
                } 
            } 
        } 
  
    } 
}