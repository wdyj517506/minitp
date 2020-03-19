<?php
// 应用公共文件
function show($status = 1, $message = 'error',$count = 0, $data = [], $httpStatus = 200)
{
    $result = [
        "code" => $status,
        "message" => $message,
        "count" =>$count,
        "data" => $data
    ];
    return json($result, $httpStatus);
}