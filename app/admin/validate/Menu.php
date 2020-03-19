<?php
/**
 * auther Marke
 * time 2020/3/18 12:25
 */


namespace app\admin\validate;


use think\Validate;

class Menu extends Validate
{
    protected $rule = [
        'authorityName' => 'require|token',
        'menuUrl' => 'require',
        'menuIcon' => 'require',
        'authority' => 'require',
        'isMenu' => 'require'
    ];
}