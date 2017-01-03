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
        $page = $this->input->get('page', true);
        if(empty($page)){
            $page = 1;
        }
        $this->load->model('Base_model');
        $all_post = $this->Base_model->get_list('', '*', 'xihua_post');
        $all_pages = count($all_post);
        $common_page = $this->common_page($page, 2, $all_pages);
        $posts = $this->Base_model->get_list('', '*', 'xihua_post', 'id DESC', $common_page['limit'], $common_page['offset']);
        $this->data['all_record'] = $all_pages;//所有的记录
        $this->data['posts'] = $posts;//当前页的数据
        $this->data['current_page'] = $page;//当前页
        $this->data['all_pages'] = $common_page['pages'];//总页数
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
    /**
     * 评论管理
     */
    public function comment(){
        $this->data['title'] = '后台评论管理首页';
        $this->data['breadcrumb'] = '评论管理';
        $page = $this->input->get('page', true);
        if(empty($page)){
            $page = 1;
        }
        $this->load->model('Base_model');
        $all_comment = $this->Base_model->get_list(array('type' => 1), '*', 'xihua_comment', 'id DESC');//评论的总数
        $all_pages = count($all_comment);
        $common_page = $this->common_page($page, 2, $all_pages);
        $join = array('table' => 'xihua_post', 'cond' => 'xihua_comment.post_id = xihua_post.id', 'type' => 'left');
        $comments = $this->Base_model->get_list_by_join(array('type' => 1), 'xihua_comment.*,xihua_post.post_title', 'xihua_comment', $common_page['limit'], $common_page['offset'], $join, 'xihua_comment.id DESC');//评论的总数
        $this->data['all_record'] = $all_pages;//所有的记录
        $this->data['comments'] = $comments;//当前页的数据
        $this->data['current_page'] = $page;//当前页
        $this->data['all_pages'] = $common_page['pages'];//总页数
        $this->load->view("admin/post/comment", $this->data);
    }
    /**
     * 通过审核
     */
    public function check_comment(){
        $id = $this->input->post('id', true);
        $status = $this->input->post('status', true);
        if(empty($id) || empty($status)){
            echo $this->apiReturn('0003', new stdClass(), $this->response_msg["0003"]);
            return;
        }
        $this->load->model('Base_model');
        $comment = $this->Base_model->get_one(array('id' => $id), '*', 'xihua_comment');
        if(empty($comment)){
            echo $this->apiReturn('0003', new stdClass(), '评论不存在');
            return;
        }
        if($comment['status'] == $status){//如果是相同的状态就不用更新
            echo $this->apiReturn('0000', new stdClass(), $this->response_msg["0000"]);
            return;
        }
        $update = $this->Base_model->update(array('status' => $status), array('id' => $id), 'xihua_comment');
        if($update){
            echo $this->apiReturn('0000', new stdClass(), $this->response_msg["0000"]);
            return;
        }else{
            echo $this->apiReturn('0002', new stdClass(), $this->response_msg["0002"]);
            return;
        }
    }
}