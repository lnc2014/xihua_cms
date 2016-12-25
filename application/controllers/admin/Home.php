<?php

/**
 * Author:LNC
 * Description: 后台首页控制器
 * Date: 2016/12/21 0021
 * Time: 下午 6:11
 */
include_once "AdminController.php";
class Home extends AdminController
{
    public function index(){
        $this->data['title'] = '后台首页';
        $this->data['breadcrumb'] = '后台首页';
        $this->load->view("admin/home/index", $this->data);
    }

}