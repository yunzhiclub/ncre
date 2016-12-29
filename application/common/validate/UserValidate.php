<?php
namespace app\common\validate;

use think\Validate;		//验证类
class UserValidate extends validate
{
    protected $rule = [
        'id_card_num'        => 'require|max:18',
        //'is_receive_message' => 'require|in:0,1',
    ];

}