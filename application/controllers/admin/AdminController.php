<?php

/**
 * Author:LNC
 * Description: xihua_cms 后台控制器基类
 * Date: 2016/12/21 0021
 * Time: 下午 6:03
 */
class AdminController extends CI_Controller
{
    public function __construct()
    {
        header("Content-type:text/html;charset=utf-8");
        session_start();
        date_default_timezone_set('PRC'); //设置中国时区
        $this->data['base_info'] = '';
        parent::__construct();
    }

}