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
		$this->load->view('template/index', $this->data);
	}
}
