<?php
/**
 * auther Marke
 * time 2020/3/14 14:30
 */

use think\facade\Route;

Route::rule("/init", "menu/getSystemInit")->ext('json');
Route::rule("/menus", "menu/menus")->ext('json');
Route::rule("/menus_old", "menu/menus_old");
Route::rule("/menus_add", "menu/menus_add");
