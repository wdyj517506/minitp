<?php
/**
 * auther Marke
 * time 2020/3/14 10:37
 */


namespace app\admin\controller;


use app\BaseController;
use think\exception\ValidateException;
use think\facade\Db;
use app\common\model\mysql\System;
use think\Request;
use think\validate\Menu as MenuValidate;

class Menu extends BaseController
{
    /**
     * @var \think\Request Request实例
     */
    protected $request;

    /**
     * 构造方法
     * @param Request $request Request对象
     * @access public
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

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

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function menus()
    {
        $menusData = new System();
        $list = $menusData->selectDataBySystem();
        //halt($list);
        $count = count($list);
        return show(config("status.success"),"调用成功", $count, $list);
    }

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function menus_old()
    {
        $list = $this->request->param('list');
        $menusData = new System();
        $list = $menusData->selectFirstDataBySystem($list);
        return show(config("status.success"),"调用成功", '', $list);
    }

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function menus_add()
    {
        $list = $this->request->param();
        $addData = new System();
        switch ($list['isMenu'])
        {
            case -1:
                $list['parentId'] = '';
                break;
            case 0:
                $list['parentId'] = $list['parentId1'];
                break;
            case 1:
                $list['parentId'] = $list['parentId2'];
                break;
        }
        $authority = $addData->selectDataByOne($list['parentId']);
        $parentUrl = $authority['menuUrl'].":".$list['authority'];
        try{
            $data = [
                'authorityName' => $list['authorityName'],
                'orderNumber' => $list['orderNumber'],
                'menuUrl' => $list['menuUrl'],
                'menuIcon' => $list['menuIcon'],
                'authority' => $parentUrl,
                'isMenu' => $list['isMenu'],
                '__token__' => $list['__token__']
            ];
            $validate = new \app\admin\validate\Menu();
            if (!$validate->check($data)) {
                return show(config("status.error"),$validate->getError());
            }
            $backData = $addData->addDataSystem($list);
            if(!empty($backData)){
                return show(config("status.success"),"添加成功",'',$authority);
            }
            return show(config("status.error"),"添加失败");
        } catch (ValidateException $e) {
            return show(config("status.error"),"内部错误");
        }

    }
}