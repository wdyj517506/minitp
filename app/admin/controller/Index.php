<?php
/**
 * auther Marke
 * time 2020/3/13 17:55
 */


namespace app\admin\controller;


use app\BaseController;
use think\facade\View;
class Index extends BaseController
{
    public function index()
    {
        return View::fetch();
    }
}