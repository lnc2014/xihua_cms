<?php
/**
 * Author:LNC
 * Description: 文件描述
 * Date: 2016/9/30 0030
 * Time: 下午 2:37
 */
include_once "upload_image.php";
$upload = new Upload_image();
$upload_success = $upload->upload('file');
if($upload_success['is_success']){
    $upload_success['is_success']  = 1;
}
echo json_encode(array(
    'code' => 1,
    'data' => array(
        'is_success' => $upload_success['is_success'],
        'path' => $upload_success['path'],
    )
));