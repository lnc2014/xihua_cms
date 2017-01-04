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
        //检验是不是登录
        if(!$this->check_login()){
            redirect('admin/home/login');
        }
        $this->load->view("admin/home/index", $this->data);
    }
    /**
     * 登录
     */
    public function login(){
        $this->data['title'] = '欢迎登录溪话工作室后台管理系统';
        if($this->check_login()){
            redirect('admin/home/index');
        }
        $this->load->view('admin/login', $this->data);
    }
    //登录验证
    public function login_check(){
        $username = $this->input->post('username');
        $psw = $this->input->post('psw');
        if(empty($username) || empty($psw)){
            echo $this->apiReturn("0000", new stdClass(), $this->response_msg["0003"]);
            return;
        }
        $psw = md5($psw);//使用md5加密
        $this->load->model('Base_model');
        $admin = $this->Base_model->get_one(array('user_name' => $username, 'psw' => $psw, 'flag' => 1), '*', 'xihua_admin');
        if(empty($admin)){
            echo $this->apiReturn('0010', new stdClass(), $this->response_msg["0010"]);
            return;
        }else{
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['user_name'] = $admin['user_name'];
        }
        echo $this->apiReturn('0000', new stdClass(), $this->response_msg["0000"]);
        return;
    }
    /**
     * 退出登录
     */
    public function login_out(){
        if(session_destroy()){
            redirect('admin/home/login');
        }
    }
    /**
     * 上传通用类
     */
    public function upload(){
        $this->load->library('upload_image');
        $ret = $this->upload_image->upload('file');
        if($ret['is_success']){
            $ret['path2'] = str_replace(FCPATH, '', $ret['path']);//将路径换成相对路径
            $ret['path'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$ret['path2'];//将路径换成相对路径
            echo $this->apiReturn('0000', $ret, 'success');
            return;
        }
        echo $this->apiReturn('0002', $ret, '上传失败');
        return;
    }
    /**
     * banner图管理
     */
    public function banner(){
        $this->data['title'] = '后台banner管理首页';
        $this->data['breadcrumb'] = '后台banner首页';
        $this->load->model('Base_model');
        $this->data['banners'] = $this->Base_model->get_list('', '*', 'xihua_banner');
        $this->load->view("admin/home/banner_index", $this->data);
    }
    /**
     * 增加banner图片
     */
    public function add_banner($banner_id = ''){
        $this->data['title'] = '后台banner管理首页';
        $this->data['breadcrumb'] = '增加banner图片';
        if(!empty($banner_id)){
            $this->load->model('Base_model');
            $this->data['banner'] = $this->Base_model->get_one(array(
                'id' => $banner_id
            ), '*', 'xihua_banner');
        }
        $this->load->view("admin/home/add_banner", $this->data);
    }
    public function add_banner_by_ajax(){
        $post = $this->input->post(NULL, true);
        if(empty($post)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg["0003"]);
            return;
        }
        $this->load->model('Base_model');
        $banner_id = $post['banner_id'];
        unset($post['banner_id']);
        if($banner_id > 0){
            $post['update_time'] = date('Y-m-d H:i:s', time());
            $post_id = $this->Base_model->update($post, array('id' => $banner_id), 'xihua_banner');
            if($post_id > 0){
                echo $this->apiReturn('0000', new stdClass(), $this->response_msg["0000"]);
                return;
            }else{
                echo $this->apiReturn('0002', new stdClass(), $this->response_msg["0002"]);
                return;
            }
        }else{
            $post['create_time'] = date('Y-m-d H:i:s', time());
            $post['update_time'] = date('Y-m-d H:i:s', time());
            $banner_id = $this->Base_model->add($post, 'xihua_banner');
            if($banner_id > 0){
                echo $this->apiReturn('0000', new stdClass(), $this->response_msg["0000"]);
                return;
            }else{
                echo $this->apiReturn('0002', new stdClass(), $this->response_msg["0002"]);
                return;
            }
        }
    }
}