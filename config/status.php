<?php
/**
 * 业务状态码配置
 * auther Marke
 * time 2020/3/11 14:40
 */

return [
    "success" => 0,
    "error" => 1,
    "not_login" => -1,
    "user_is_register" => -2,
    "action_not_found" => -3,
    "controller_not_found" => -3,

    //mysql相关的状态配置
    "mysql" =>[
        "table_normal" =>1, //正常
        "table_pedding" => 0, //待审
        "table_delete" =>99, //删除
    ],
];
