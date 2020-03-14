<?php
/**
 * auther Marke
 * time 2020/3/14 10:37
 */


namespace app\admin\controller;


use app\BaseController;
use think\facade\Db;
use app\common\model\mysql\System;

class Menu extends BaseController
{
    /**获取初始化数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getSystemInit(){
        $homeInfo = [
            'title' => '首页',
            'href'  => 'welcome1',
        ];
        $logoInfo = [
            'title' => 'LAYUI MINI',
            'image' => '/static/layuimini/images/logo.png',
        ];
        $menuInfo = $this->getMenuList();
        $systemInit = [
            'homeInfo' => $homeInfo,
            'logoInfo' => $logoInfo,
            'menuInfo' => $menuInfo,
        ];
        return json($systemInit);
    }

    /**
     * 获取菜单列表
     * @return array|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function getMenuList(){
        $menuList = Db::name('menu')
            ->field('id,pid,title,icon,href,target')
            ->where('status', 1)
            ->order('sort', 'desc')
            ->select();
        $menuList = $this->buildMenuChild(0, $menuList);
        return $menuList;
    }

    /**
     * 递归获取子菜单
     * @param $pid
     * @param $menuList
     * @return array
     */
    private function buildMenuChild($pid, $menuList){
        $treeList = [];
        foreach ($menuList as $v) {
            if ($pid == $v['pid']) {
                $node = $v;
                $child = $this->buildMenuChild($v['id'], $menuList);
                if (!empty($child)) {
                    $node['child'] = $child;
                }
                // todo 后续此处加上用户的权限判断
                $treeList[] = $node;
            }
        }
        return $treeList;
    }

    public function menus()
    {
        $menusData = new System();
        $list = $menusData->selectDataBySystem();
        //halt($list);
        $count = count($list);
        return show(config("status.success"),"调用成功", $count, $list);
    }
}