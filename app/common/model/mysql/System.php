<?php
/**
 * auther Marke
 * time 2020/3/14 11:43
 */


namespace app\common\model\mysql;


use think\Model;

class System extends Model
{
    static public function selectDataBySystem()
    {
        $result = System::where('checked','0')
            ->order('orderNumber', 'asc')
            ->select();
        return $result;
    }
}