<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
	/**
	 * 网站首页
	 */
	private $data;
	public function index()
	{
		$this->load->model('Base_model');
		$this->data['post'] = $this->Base_model->get_list('', '*', 'xihua_post');
		$this->data['all_posts'] = $this->Base_model->get_list('', '*', 'xihua_post', 'create_time DESC', 10, 0);//首页所有的文章
		$this->data['all_posts_read'] = $this->Base_model->get_list('', '*', 'xihua_post', 'read_time DESC', 8, 0);//首页热门文章
		$this->data['all_posts_comment'] = $this->Base_model->get_list('', '*', 'xihua_post', 'comment DESC', 8, 0);//首页评论最多文章
		$this->data['banner'] = $this->Base_model->get_list(array('is_show' => 1), '*', 'xihua_banner', 'create_time DESC', 8, 0);//首页评论最多文章

		$this->load->view('template/index', $this->data);
	}
	public function post_detail($post_id){
		if(empty($post_id)){
			echo "<script>
                        alert('非法请求');
                        window.location.href='/';
                      </script>";
			exit;
		}
		$this->load->model('Base_model');
		$post = $this->data['post'] = $this->Base_model->get_one(array('id' => $post_id), '*', 'xihua_post');
		$this->data['comment'] = $this->Base_model->get_list(array('post_id' => $post_id, 'type' => 1, 'status' => 1), '*', 'xihua_comment');
		if(empty($this->data['post'])){
			echo "<script>
                        alert('非法请求');
                        window.location.href='/';
                      </script>";
			exit;
		}
		$this->Base_model->update(array('read_time' => bcadd($post['read_time'], 1)), array('id' => $post_id),  'xihua_post');
		$this->load->view('template/post_detail', $this->data);
	}

	/**
	 * 获取文章
	 * @param string $is_controller
	 */
	public function get_post($is_controller = ''){
		$page = $this->input->post('page', true);
		if($is_controller = true){
			$page = 1;
		}elseif(empty($page)){
			echo $this->apiReturn('0003', new stdClass(), '非法参数');
			return;
		}
		$this->load->model('Base_model');
		$common_page = $this->common_page($page, 10);
		$posts = $this->Base_model->get_list('', '*', 'xihua_post', 'create_time DESC', $common_page['limit'], $common_page['offset']);
		if($is_controller == true){
			return $posts;
		}else{
			echo $this->apiReturn('0000', $posts, 'success');
			return;
		}
	}
	public function add_comment(){
		session_start();
		if(isset($_SESSION['user_id'])){
			echo $this->apiReturn('0005', new stdClass(), '你已经提交过评论，请勿重复评论');
			return;
		}
		$post_id = $this->input->post('post_id', true);
		$name = $this->input->post('name', true);
		$email = $this->input->post('email', true);
		$content = $this->input->post('content', true);
		if(empty($post_id) || empty($name) || empty($email) || empty($content)){
			echo $this->apiReturn('0003', new stdClass(), '非法参数');
			return;
		}
		$this->load->model('Base_model');
		$post =  $this->Base_model->get_one(array('id' => $post_id), '*', 'xihua_post');

		if(empty($post)){
			echo $this->apiReturn('0003', new stdClass(), '非法请求');
			return;
		}
		$comment_id = $this->Base_model->add(array(
			'post_id' => $post_id,
			'name' => $name,
			'email' => $email,
			'comment' => $content,
			'flag' => 1,
			'create_time' => date('Y-m-d H:i:s', time()),
			'update_time' => date('Y-m-d H:i:s', time()),
		), 'xihua_comment');
		if($comment_id > 0){
			$_SESSION['user_id'] = 'xihua';
			echo $this->apiReturn('0000', new stdClass(), 'success');
			return;
		}else{
			echo $this->apiReturn('0002', new stdClass(), '服务器错误');
			return;
		}
	}
	/**
	 * 接口api统一结果处理
	 * @param $result
	 * @param $data
	 * @param $info
	 * @return string
	 */
	public function apiReturn($result, $data, $info)
	{
		$arr["result"] = $result;
		$arr["data"] = $data === null ? '' : $data;
		$arr["info"] = $info;
		$res = json_encode($arr);
		return $res;
	}
	/**
	 * 公共分页函数
	 * @param int $page
	 * @param int $page_size
	 * @param $all_pages
	 * @return array
	 */
	public function common_page($page = 1, $page_size = 20){
		$limit = $page_size;
		if(empty($page) || $page == 1){
			$offset = 0;
		}else{
			$offset =  ($page-1)*$page_size;
		}
		return array(
				'limit' => $limit,//数据库每条数据的起始条数
				'offset' => $offset,//数据库的偏移量
		);
	}
}
