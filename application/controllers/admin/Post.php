<?php

/**
 * Author:LNC
 * Description: 后台内容控制器
 * Date: 2016/12/21 0021
 * Time: 下午 6:11
 */
include_once "AdminController.php";
class Post extends AdminController
{
    public function index(){
        $this->data['title'] = '后台文章管理首页';
        $this->data['breadcrumb'] = '后台文章管理首页';
        $this->load->view("admin/post/index", $this->data);
    }

    public function add_post(){
        $this->data['title'] = '增加文章';
        $this->data['breadcrumb'] = '增加文章';
        $this->load->view("admin/post/add_post", $this->data);
    }
}