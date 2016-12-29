<?php
namespace app\common\validate;

use think\Validate;		//验证类
class UserValidate extends validate
{
    protected $rule = [
        ['id_card_num', 'checkIDCardNumLength:18', '身份证格式错误'],
    ];

    protected function checkIDCardNumLength($IDCardNum, $rule) {
        // 较验openid的长度
        if (strlen($IDCardNum) === 18) {
            return true;   
        } else {
            return '身份证只能是' . $rule . '位长度';
        }
        
    }
}