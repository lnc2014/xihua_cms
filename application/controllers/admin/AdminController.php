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
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
        session_start();
        date_default_timezone_set('PRC'); //设置中国时区
        $this->config->load('common/config_response', TRUE); //统一返回状态码loading
        $this->load->helper('url');
        $this->response_msg = $this->config->item('response', 'common/config_response');
        $this->data['base_info'] = '';
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
     * 检测是不是已经登录
     */
    public function check_login(){
        //检测用户是否已经登录授权过
        if(isset($_SESSION['admin_id']) && isset($_SESSION['user_name'])){
            return true;
        }
        return false;
    }
    /**
     * 公共分页函数
     * @param int $page
     * @param int $page_size
     * @param $all_pages
     * @return array
     */
    public function common_page($page = 1, $page_size = 20, $all_pages){
        $limit = $page_size;
        if(empty($page) || $page == 1){
            $offset = 0;
        }else{
            $offset =  ($page-1)*$page_size;
        }
        $pages = ceil($all_pages/$page_size);
        return array(
            'limit' => $limit,//数据库每条数据的起始条数
            'offset' => $offset,//数据库的偏移量
            'pages' => $pages,//页数
        );
    }
}