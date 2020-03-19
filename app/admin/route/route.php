<?php
/**
 * auther Marke
 * time 2020/3/14 9:44
 */
use think\facade\Route;

Route::rule("/", "index/index");
Route::rule("/welcome1", "page/welcome1");
Route::rule("/menu", "page/menu");
Route::rule("/menu-add", "page/menu_add");
Route::rule("/menu-edit", "page/menu_edit");