<?php
/**
 * auther Marke
 * time 2020/3/14 11:43
 */


namespace app\common\model\mysql;


use think\Model;

class System extends Model
{
    /**
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    static public function selectFirstDataBySystem($list = -1)
    {
        $where = [
            'checked' => 0,
            'parentId' => $list
        ];
        $result = System::where($where)
            ->order('orderNumber', 'asc')
            ->field('authorityId,authorityName,orderNumber,parentId')
            ->select();
        return $result->toArray();
    }

    /**
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    static public function selectDataBySystem()
    {
        $where = [
            'checked' => 0
        ];
        $result = System::where($where)
            ->order('orderNumber', 'asc')
            ->select();
        return $result;
    }

    /**
     * @param string $list
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    static public function selectSunDataBySystem($list = '')
    {
        $where = [
            'checked' => 0,
            'parentId' => $list
        ];
        $result = System::where('parentId','=', $list)
            ->order('orderNumber', 'asc')
            ->select();
        return $result;
    }

    /**
     * @param string $list
     * @return System
     */
    static public function addDataSystem ($list = '')
    {
        $addData = new System();
        $addData->authorityName = $list['authorityName'];
        $addData->orderNumber = $list['orderNumber'];
        $addData->menuUrl = $list['menuUrl'];
        $addData->menuIcon = $list['menuIcon'];
        $addData->authority = $list['authority'];
        $addData->isMenu = $list['isMenu'];
        $addData->parentId = $list['parentId'];
        $addData->save();
        return $addData;
    }

    /**
     * @param string $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    static public function selectDataByOne($data = '')
    {
        $selectData = System::where('authorityId', $data)
            ->find();
        return $selectData;
    }
}