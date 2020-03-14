<?php
/**
 * auther Marke
 * time 2020/3/14 9:39
 */


namespace app\admin\controller;

use think\facade\View;
use app\BaseController;
use think\facade\Db;
class Page extends BaseController
{
    public function welcome1()
    {
        return View::fetch();
    }

    public function menu()
    {
        return View::fetch();
    }

    public function menu_add()
    {
        return View::fetch();
    }
}