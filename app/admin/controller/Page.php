<?php
/**
 * auther Marke
 * time 2020/3/14 9:39
 */


namespace app\admin\controller;

use think\facade\View;
use app\BaseController;
use app\common\model\mysql\System;
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
        $result = new System();
        $list = -1;
        $list = $result->selectFirstDataBySystem($list);
        View::assign('list',$list);
        return View::fetch();
    }

    public function menu_edit()
    {
        $result = new System();

        $aid = $this->request->param();
        $dateil = $result->selectDataByOne($aid['id']);

        $list = -1;
        $list = $result->selectFirstDataBySystem($list);

        View::assign('detail', $dateil);
        View::assign('list',$list);
        return View::fetch();
    }
}