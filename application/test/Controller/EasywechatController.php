<?php
namespace app\test\controller;
use EasyWeChat\Card\Card;

class EasywechatController {
    public function index() {
        $Card = new Card;
        $Card->index();
    }
}