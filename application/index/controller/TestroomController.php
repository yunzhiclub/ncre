<?php
namespace app\index\controller;
use think\Controller;
use app\model\TestroomModel;
/**
* 
*/
class TestroomController extends Controller
{
    
    public function index()
    {
        $TestroomModel = TestroomModel::select();
        var_dump($TestroomModel);
    }
}
