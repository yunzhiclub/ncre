<?php
namespace app\common\validate;

use think\Validate;		//验证类
class UserValidate extends validate
{
    protected $rule = [
        ['id_card_num', 'checkIDCardNumLength:15/18', '身份证格式错误，请重新输入'],
    ];

    protected function checkIDCardNumLength($IDCardNum) {

        $IDCardNum = strtoupper($IDCardNum); 
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/"; 
        $arr_split = array(); 
        if (!preg_match($regx, $IDCardNum)) { 
            return false; 
        } 

        //检查15位 
        if (15 == strlen($IDCardNum)) { 
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/"; 
  
            @preg_match($regx, $IDCardNum, $arr_split); 
            //检查生日日期是否正确 
            $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4]; 
            if(!strtotime($dtm_birth)) { 
                return false; 
            } else { 
                return true; 
            } 
        } 
        //检查18位 
        else { 
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/"; 
            @preg_match($regx, $IDCardNum, $arr_split); 
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];

            //检查生日日期是否正确 
            if (!strtotime($dtm_birth)) { 
                return false; 
            } else { 
                //检验18位身份证的校验码是否正确。 
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。 
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
                if ($val_num != substr($IDCardNum,17, 1)) { 
                    return false; 
                } else { 
                    return true; 
                } 
            } 
        } 
  
    } 
}