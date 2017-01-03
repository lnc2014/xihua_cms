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
    public function __construct()
    {
        parent::__construct();
        //检验是不是登录
        if(!$this->check_login()){
            redirect('admin/home/login');
        }
    }
    public function index(){
        $this->data['title'] = '后台文章管理首页';
        $this->data['breadcrumb'] = '后台文章管理首页';
        $this->load->model('Base_model');
        $this->data['post'] = $this->Base_model->get_list('', '*', 'xihua_post');
        $this->load->view("admin/post/post_index", $this->data);
    }
    /**
     * 增加文章
     * @param string $post_id
     */
    public function add_post($post_id = ''){
        $this->data['title'] = '增加文章';
        $this->data['breadcrumb'] = '增加文章';
        $this->data['post'] = array();
        if(!empty($post_id)){
            $this->load->model('Base_model');
            $this->data['post'] = $this->Base_model->get_one(array(
                'id' => $post_id
            ), '*', 'xihua_post');
        }
        $this->load->model('Base_model');
        $this->data['post_cate'] = $this->Base_model->get_list('', '*', 'xihua_post_cat');
        $this->load->view("admin/post/add_post", $this->data);
    }
    /**
     * 添加到数据库
     */
    public function add_post_by_ajax(){
        $post = $this->input->post(NULL, true);
        if(empty($post)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg["0003"]);
            return;
        }
        $this->load->model('Base_model');
        $post_id = $post['post_id'];
        unset($post['post_id']);
        if($post_id > 0){
            $post['update_time'] = date('Y-m-d H:i:s', time());
            $post_id = $this->Base_model->update($post, array('id' => $post_id), 'xihua_post');
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
            $post['flag'] = 1;
            $post_id = $this->Base_model->add($post, 'xihua_post');
            if($post_id > 0){
                echo $this->apiReturn('0000', new stdClass(), $this->response_msg["0000"]);
                return;
            }else{
                echo $this->apiReturn('0002', new stdClass(), $this->response_msg["0002"]);
                return;
            }
        }
    }
    public function cate_list(){
        $this->data['title'] = '后台文章管理首页';
        $this->data['breadcrumb'] = '后台文章管理首页';
        $this->load->model('Base_model');
        $this->data['post'] = $this->Base_model->get_list('', '*', 'xihua_post_cat');
        $this->load->view("admin/post/cate_index", $this->data);
    }
    public function add_post_cate($post_id = ''){
        $this->data['title'] = '增加文章分类';
        $this->data['breadcrumb'] = '增加文章分类';
        $this->data['post'] = array();
        if(!empty($post_id)){
            $this->load->model('Base_model');
            $this->data['post'] = $this->Base_model->get_one(array(
                'id' => $post_id
            ), '*', 'xihua_post_cat');
        }
        $this->load->view("admin/post/add_post_cate", $this->data);
    }
    public function add_post_cate_by_ajax(){
        $post = $this->input->post(NULL, true);
        if(empty($post)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg["0003"]);
            return;
        }
        $this->load->model('Base_model');
        $post_id = $post['cate_id'];
        unset($post['cate_id']);
        if($post_id > 0){
            $post['update_time'] = date('Y-m-d H:i:s', time());
            $post_id = $this->Base_model->update($post, array('id' => $post_id), 'xihua_post_cat');
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
            $post['flag'] = 1;
            $post_id = $this->Base_model->add($post, 'xihua_post_cat');
            if($post_id > 0){
                echo $this->apiReturn('0000', new stdClass(), $this->response_msg["0000"]);
                return;
            }else{
                echo $this->apiReturn('0002', new stdClass(), $this->response_msg["0002"]);
                return;
            }
        }
    }
    /**
     * 公共删除方法
     * @param $id
     * @param $table_name
     */
    public function delete(){
        $id = $this->input->post('id', true);
        $table_name = $this->input->post('table_name', true);
        if(empty($id) || empty($table_name)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg["0003"]);
            return;
        }
        $this->load->model('Base_model');
        $delete = $this->Base_model->delete(array('id' => $id), $table_name);
        if($delete){
            echo $this->apiReturn('0000', new stdClass(), $this->response_msg["0000"]);
            return;
        }else{
            echo $this->apiReturn('0002', new stdClass(), $this->response_msg["0002"]);
            return;
        }
    }
}