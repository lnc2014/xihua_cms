<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header("Content-type:text/html;charset=utf-8");
        session_start();
        date_default_timezone_set('PRC'); //设置中国时区
        $this->config->load('common/config_response', TRUE); //统一返回状态码loading
        $this->load->helper('url');
        $this->response_msg = $this->config->item('response', 'common/config_response');
        
        // 以前都用户信息都用session存，局部数据更新，session都没更新， 暂时只能重新登陆了
        $this->data['base_info'] = isset($_SESSION['u_phone']) ? $this->get_base_info() : array();
        $this->data['menu_auth'] = isset($_SESSION['menu_auth']) ? explode(',', $_SESSION['menu_auth']) : array();
        
        // TODO目前暂时不做通过nodes表鉴权的功能， 有需要后期可能立工期专门做
        if (!empty($_SESSION['u_id'])) {
            
            $this->get_user_roles();
            
            // 检测菜单是否存在
            if (!isset($_SESSION[$this->config->item('rbac_auth_key')]['menu'])) {
                $auth_menu = $this->get_menu($_SESSION['u_id']);
                $_SESSION[$this->config->item('rbac_auth_key')]['menu'] = $auth_menu;
            }
            
            //目录
            $directory = substr($this->router->fetch_directory(),0,-1);
            //控制器
            $controller = $this->router->fetch_class();
            //方法
            $function = $this->router->fetch_method();
            
            $this->data['selected_menu'] = get_selected_menu($directory, $controller, $function);
            //var_dump($_SESSION[$this->config->item('rbac_auth_key')]['menu']);
        }
    }
    
    protected  function get_menu() 
    {
        $this->load->model('admin/M_cw_menus', 'cw_menus');
        
        return $this->cw_menus->get_auth_menu(intval($_SESSION['u_id']));
    }
    
    protected function get_user_roles() 
    {
        if (!isset($_SESSION[$this->config->item('rbac_auth_key')]['roles'])) {
            $this->load->model('admin/M_user_role', 'user_role');
            $user_roles = $this->user_role->get_list(array('uid' => intval($_SESSION['u_id'])));
            $user_role_ids = multi_array_to_array_by_key($user_roles, 'role_id');
            
            // _user_role 默认用来存储和用户有关的
            $_SESSION[$this->config->item('rbac_auth_key')]['roles'] = $user_role_ids;
        }
        
        $this->data['_user_role']['is_super'] = in_array('1', $_SESSION[$this->config->item('rbac_auth_key')]['roles']); // 是否超级管理员
        $this->data['_user_role']['is_pers'] = in_array('5', $_SESSION[$this->config->item('rbac_auth_key')]['roles']);  // 是否人事
    }
    
    /**
     * 返回统一结果处理（支持ajax和form表单提交）
     * @param $result
     * @param $data
     * @param $info
     * @return string
     */
    public function api_return($result, $data, $info) {
        //防止多次提交
        $method_name = $this->router->fetch_method();
        if(isset($_SESSION[$method_name])){
            session_start();
            unset($_SESSION[$method_name]);
        }
        
        $arr["result"] = $result;
        $arr["data"] = $data === null ? '' : $data;
        $arr["info"] = $info;
        return json_encode($arr);
        return '<script>alert("'.$info.'");history.go(-1);</script>';
    }

    /**
    * 记录日志
    * @param $data
    * @param $name
    * @param string $interval
    */
    public function logs_debug($data ,$name ,$interval = 'day') {
        $this->load->library('log/Logger');
        $data['IP'] = (string) $_SERVER['REMOTE_ADDR'];
        $this->logger->logs_debug($data, $name ,$interval);
    }

    /**
     * session 判断
     */
    public function session() {
        if (!$_SESSION['actual_name'] || !$_SESSION['u_phone']) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
                $openid = $this->get_user_openid();
                $user_info = $this->get_system_user_info($openid);
                if (!empty($user_info)) {
                    $_SESSION['actual_name'] = $user_info['actual_name'];
                    $_SESSION['u_phone'] = $user_info['u_phone'];
                    $_SESSION['u_id'] = $user_info['u_id'];
                    $_SESSION['slave_role'] = $user_info['slave_role'];
                    $_SESSION['sub_role'] = $user_info['sub_role'];
                    $_SESSION['menu_auth'] = $user_info['menu_auth'];
                    $_SESSION['motorcade_id'] = $user_info['motorcade_id'];
                    $_SESSION['m_province_id'] = $user_info['province_id'];
                    $_SESSION['m_city_id'] = $user_info['city_id'];
                } else {
                    redirect("admin/register");
                }
            } else {
                redirect("admin/login");
            }
        }
    }

    /**
     * 获取系统用户信息
     * @return string
     */
    public function get_system_user_info($openid) {
        $this->load->model('m_system_user');
        $user_info = $this->m_system_user->get_system_user_info(array('wx_openid' => $openid, 'motorcade_id>' => 0), true);
        return $user_info;
    }

    /**
     * 获取微信用户openid
     * @return string
     */
    public function get_user_openid($type = 'cw'){
        include_once(FCPATH . "public/{$type}-pay/WxOpenIdHelper.php");
        $wxopenidhelper = new WxOpenIdHelper();
        return $wxopenidhelper->getOpenId();
    }

    /**
     * 获取基础信息
     * @return array
     */
    public function get_base_info() {
        $base_info = array();
        //获取导航栏
        $this->load->model('m_system_menu');
        $system_menu = $this->m_system_menu->get_system_menu(); //获取导航栏
        $system_menu = $this->menu_recursive($system_menu);
        $menuArr = array();
        foreach ($system_menu as $k => $v) {
            if ($v['level']  == 0) {
                $menuArr[$v['id']] = $v;
                $menuArr[$v['id']]['submenu'] = array();
            }
			elseif($v['level']  == 1) {
                $menuArr[$v['father_id']]['submenu'][$v['id']] = $v;
            }
            elseif($v['level']  == 2){
                $level_1 = $v['father_id'];
                foreach ($system_menu as $k2 => $v2) {
                    if($v2['id'] == $level_1){
                        $level_0 = $v2['father_id'];
                        break;
                    }
                }
                $menuArr[$level_0]['submenu'][$level_1]['submenu'][$v['id']] = $v;
            }
            elseif($v['level']  == 3){
                $level_2 = $v['father_id'];
                foreach ($system_menu as $k2 => $v2) {
                    if($v2['id'] == $level_2){
                        $level_1 = $v2['father_id'];
                        foreach ($system_menu as $k1 => $v1) {
                            if($v1['id'] == $level_1){
                                $level_0 = $v1['father_id'];
                                break;
                            }
                        }
                    }
                }
                $menuArr[$level_0]['submenu'][$level_1]['submenu'][$level_2]['submenu'][$v['id']] = $v;
            }   
        }
        $base_info['system_menu'] = array_values($menuArr);
        //获取用户基本信息
        $this->load->model('M_system_user');
        $system_user = $this->M_system_user->get_user_info(array('u_phone'=>$_SESSION['u_phone']));
        $base_info['system_user'] = $system_user[0];
        return $base_info;
    }

    /**
     * 导航栏排序
     * @param $arr
     * @param int $pid
     * @param int $level
     * @return array
     */
    public function menu_recursive($arr, $pid=0, $level=0) {
        static $list = array();
        foreach ($arr as $v) {
            if ($v['father_id'] == $pid) {
                $v['level'] = $level;
                $list[] = $v;
                $this->menu_recursive($arr,$v['id'],$level+1);
            }
        }
        return $list;
    }


    /**
     * 分页处理
     * @param $data
     */
    public function pagination($data = array()) {
        $this->load->library('pagination');
        $config['base_url'] = $data['base_url'];  //这是一个指向你的分页所在的控制器类/方法的完整的 URL
        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = 1;
        $config['num_links'] = 4;
        $config['total_rows'] = $data['total_rows'];  //需要做分页的数据的总行数。通常这个数值是你查询数据库得到的数据总量。
        $config['per_page'] = $data['per_page'] ? $data['per_page'] : 20;  //每个页面中希望展示的数量

        //自定义第一个链接
        $config['first_link'] = '首页';  //左边第一个链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
        $config['first_tag_open'] = '<span>';  //第一个链接的起始标签。
        $config['first_tag_close'] = '</span>';  //第一个链接的结束标签。

        //自定义最后一个链接
        $config['last_link'] = '末页';  //右边最后一个链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
        $config['last_tag_open'] = '<span>';  //最后一个链接的起始标签。
        $config['last_tag_close'] = '</span>';  //最后一个链接的结束标签。

        //自定义下一页链接
        $config['next_tag_open'] = '<span>';  //下一页链接的起始标签。
        $config['next_tag_close'] = '</span>';  //下一页链接的结束标签。

        //自定义上一页链接
        $config['prev_tag_open'] = '<span>';  //上一页链接的起始标签。
        $config['prev_tag_close'] = '</span>';  //上一页链接的结束标签。

        //自定义当前页面链接
        $config['cur_tag_open'] = '<span class="btn btn-primary">';  //当前页链接的起始标签。
        $config['cur_tag_close'] = '</span>';  //当前页链接的结束标签。

        //自定义数字链接
        $config['num_tag_open'] = '<span>';  //数字链接的起始标签。
        $config['num_tag_close'] = '</span>';  //数字链接的结束标签。

        //给链接添加属性
        // Produces: class="btn"
        $config['attributes'] = array('class' => 'btn btn-outline btn-primary');
        $this->pagination->initialize($config);
    }

	/**
     * 增加查询条件
     * @return string
     */
	public function add_where($add_where, $key, $val, $operator='',$alias='') {
		$opt = '=';
		if($operator != ''){
			switch ($operator) {
				case 'like':
					$opt = ' like ';
					$val = '%'.$val.'%';
					break;
				case 'in':
					$opt = ' in ';
					$val = '('.$val.')';
					break;
				case '!=':
					$opt = ' != ';
					break;
				case '>=':
					$opt = ' >= ';
					break;
				case '<=':
					$opt = ' <= ';
					break;
				case '<':
					$opt = ' < ';
					break;
				case '>':
					$opt = ' > ';
					break;
				case '<>':
					$opt = ' <> ';
					break;
			}
		}

		if($alias){
			if($add_where == ''){
				$add_where = $opt==' in ' ? " $alias.$key".$opt."$val " : " $alias.$key".$opt."'$val' ";
			}
			elseif(!stristr($add_where,'and')){
				$add_where .= $opt==' in ' ? " and $alias.$key".$opt."$val " : " and $alias.$key".$opt."'$val' ";
			}
			else{
				$add_where .= $opt==' in ' ? " and $alias.$key".$opt."$val " : " and $alias.$key".$opt."'$val' ";
			}
		}
		else{
			if($add_where == ''){
				$add_where = $opt==' in ' ? " $key".$opt."$val " : " $key".$opt."'$val' ";
			}
			elseif(!stristr($add_where,'and')){
				$add_where .= $opt==' in ' ? " and $key".$opt."$val " : " and $key".$opt."'$val' ";
			}
			else{
				$add_where .= $opt==' in ' ? " and $key".$opt."$val " : " and $key".$opt."'$val' ";
			}
		}
		return $add_where;
	}

    /**
     * 引入PHPExcel插件
     * @param $file_path
     * @return array
     */
    public function phpexcel($file_path) {
        require_once 'application/libraries/PHPExcel/Classes/PHPExcel.php';
        require_once 'application/libraries/PHPExcel/Classes/PHPExcel/IOFactory.php';
        require_once 'application/libraries/PHPExcel/Classes/PHPExcel/Reader/Excel5.php';

        $reader = PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)
        $PHPExcel = $reader->load($file_path); // 载入excel文件
        $sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumm = $sheet->getHighestColumn(); // 取得总列数
        $excel_data = array();
        /** 循环读取每个单元格的数据 */
        for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
            for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始
                $dataset[] = $sheet->getCell($column.$row)->getValue();
//                    echo $column.$row.":".$sheet->getCell($column.$row)->getValue()."<br />";
                $excel_data[$row-2][$column] = $sheet->getCell($column.$row)->getValue();
            }
        }
        return $excel_data;
    }

    /**
     * 计算工作日
     * @param $start （时间戳）
     * @param $end （时间戳）
     * @param $that_day (当天是否算上)
     * @return float
     */
    public function work_days($start, $end, $that_day) {
        $end < $start && exit;

        $rule_out_days = 0;
        //排除节假日
        $holidays = $this->config->config['holidays'];
        for ($i=0; $i<count($holidays); $i++) {
            if ($start <= strtotime($holidays[$i]) && strtotime($holidays[$i]) < $end) {
                $rule_out_days += 1;
            }
        }

        $double =  ($end - $start)/(7*24*3600);
        $double = floor($double);
        $start = date('w',$start);
        $end   = date('w',$end);
        $end = $start > $end ? $end + 5 : $end;

        if ($that_day) {
            return $double * 5 + $end - $start - $rule_out_days + 1;
        } else {
            return $double * 5 + $end - $start - $rule_out_days;
        }
    }

    /**
     * 上传文件OSS
     * @param $date['object'] 文件路径以及文件名
     * @param $date['content'] 文件临时目录
     * @return mixed
     */
    public function uplaod_oss($date) {
        $this->load->library('oss/alioss');

        $object = $date['object'];
        $content  = file_get_contents($date['content']);

        $options = array(
            'content' => $content,
            'length' => strlen($content),
        );

        $ret = $this->alioss->upload_file_by_content('dudubashi', $object, $options);

        return $ret->status;
    }

    /**
     * 重命名为时间戳
     * @param $name
     * @return string
     */
    public function rename_timestamp($name) {
        $name_arr = explode('.',$name);
        $new_name = time().'.'.$name_arr[count($name_arr)-1];
        return $new_name;
    }
	
	/**
	 * 根据province_id获取城市列表
	 */
	public function get_citylist_by_provinceid($province_id){
		$this->load->model('m_city');
		$c_list = array();
		$c_info = $this->m_city->get_city_info(array('province_id'=>$province_id));
		if(count($c_info)>0){
			foreach ($c_info as $k => $v) {
				$c_list[$v['city_id']] = $v['city_name'];
			}
		}
		return $c_list;
	}

	/**
	 * 根据city_id获取车队列表
	 */
	public function get_motorlist_by_cityid($city_id){
		$this->load->model('m_motorcade');
		$m_info = $this->m_motorcade->get_motorcade_info(array('city_id'=>$city_id));
		if(count($m_info)>0){
			foreach ($m_info as $k => $v) {
				$m_list[$v['ltb_motorcade_id']] = $v['motorcade_name'];
			}
		}
		return $m_list;
	}

    /*
     * 操作记录
     */
    public function operation_log($data) {
        $this->load->model('m_system_operation');
        $data['name'] = $_SESSION['actual_name'];
        $ret = $this->m_system_operation->insert_operation($data);
        return $ret;
    }
	
    /**
     * 简单分页生成-通用函数
     * 
     * @param int 		$total	总行数
     * @param string 	$action 行为函数名称 如: 'motorcade_info'
     * @param int 		$per_p	每页行数	default 10
     */
    protected function construct_pagination($total, $action, $per_p=10)
    {	
    	// 当前页面数偏移量
    	$per_page = $this->input->get('per_page');
    	$per_page = isset($per_page) ? $per_page : 0;
    	
    	// 分页
    	$pagination = array(
    			'base_url' 		=> $action,
    			'total_rows' 	=> $total,
    			'per_page' 		=> $per_p
    	);
    	$this->pagination($pagination);
    	
    	// 分页结果集
    	$res = array(
    			'links' => $this->pagination->create_links()
    			,'per_p' => $per_p
    			,'per_page' => $per_page
    	);
    	
    	return $res;
    }
    
    /**
     * 检测是否有效车队账号
     */
    protected function is_motorcade()
    {
    	$res = intval($_SESSION['motorcade_id']);
    	if($res<=0){
    		exit('<script>alert("未获取到相关信息, 请联系系统管理员处理!"); history.go(-1);</script>');
    	}
    	
    	 return $res;
    }

    /**
     * 获取系统所有的车队
     *
     */
    protected function get_system_motorcade()
    {
        $this->load->model('M_motorcade');
        $where = "motorcade_type = 2 and ltb_motorcade_id != {$_SESSION['motorcade_id']}";
        $motorcades = $this->M_motorcade->get_list($where,'motorcade_name, ltb_motorcade_id');
        return $motorcades;
    }
    
    /**
     * 检测是否有效车队账号
     */
    protected  function check_motorcade_from_ajax() 
    {
        $motorcade_id = intval($_SESSION['motorcade_id']);
        if($motorcade_id <= 0){
            echo $this->api_return('0204', '', $this->response_msg['0204']);exit;
        }
        
        return $motorcade_id;
    }
    
    /**
     * 验证表单
     *
     * @param array $validate_fields 验证表单数组
     *        |-- string name   包含域名    必须与form表单域中的name值相同
     *        |-- array  rules  验证规则    例如 array('reqiured','numeric')
     *        |-- string msg    提示信息
     */
    protected  function _validate_form($validate_fields)
    {
        if (!empty($validate_fields)) {
            $res = array();
            	
            foreach ($validate_fields as $val) {
                if (!empty($val['rules'])) {
                    $_common_res = array();
                    foreach($val['rules'] as $r) {
                        // 统一所有验证规则 ci 返回的结果都是error， 用于判断哪个字段验证失败，提示另外定义
                        $_common_res[$r] = 'error';
                    }
                    $this->form_validation->set_rules($val['name'], $val['name'], $val['rules'], $_common_res);
                }
            }
            	
            if ($this->form_validation->run() === FALSE) {
                foreach ($validate_fields as $val) {
                    $content = form_error($val['name']);
                    // CI 验证判断范围大小的，无法自定义提示内容如error，暂时用判空来确认那个表单域非法
                    if (!empty($content)) {
                        $res['name'] = $val['name'];
                        $res['msg']  = $val['msg'];
    
                        break;
                    }
                }
                 
                echo $this->api_return('0016', $res, 'error');exit;
            }
        }
    }

    //检测验证码信息
    protected function check_sms_log($phone,$code){
        $sms_expire = 600; // 默认登录超时时间为10分钟
        
        $this->load->model('m_sms_log');
        $sms = $this->m_sms_log->get_last_code_by_phone($phone);//获取验证码信息
        
        if ($sms == false || count($sms) < 1 || $sms['code'] != $code) {//查询不到验证码
            exit($this->api_return("0012", new stdClass(), $this->response_msg['0012']));
        }
        
        if (time() > (strtotime($sms['create_time']) + $sms_expire)) {//验证码过期
            exit($this->api_return("0013", new stdClass(), $this->response_msg['0013']));
        }
    }
    
    protected function check_role($role_ids = array())
    {
        foreach ($role_ids as $role_id) {
            if (in_array($role_id, $_SESSION[$this->config->item('rbac_auth_key')]['roles'])) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * 导航栏样式类型
     */
    public function navbar_type() {
        if ($_SESSION['navbar_type']) {
            $_SESSION['navbar_type'] = FALSE;
        } else {
            $_SESSION['navbar_type'] = TRUE;
        }
    }
    /**
     * 防止重复提交
     */
    public function refund_repeat(){
        $method_name = $this->router->fetch_method();
        if (isset($_SESSION[$method_name]) && $_SESSION[$method_name] == 1) {
            $arr["result"] = "0018";
            $arr["data"] = new stdClass();
            $arr["info"] = $this->response_msg["0018"];
            exit(json_encode($arr));
        }
        $_SESSION[$method_name] = 1;
        session_write_close();
    }
	/**
	 * 生成唯一字符串
	 */
	public function create_guid() {
	   $charid = strtoupper(md5(uniqid(mt_rand(), true)));
	   $uuid = substr($charid, 0, 8).substr($charid, 8, 4).substr($charid,12, 4).substr($charid,16, 4).substr($charid,20,12);
	   return $uuid;
	}
	
	/**
	 * 保存工具函数  (修改这个函数时还请告知下Hong)
	 *
	 * @param string    $_model     模型别名
	 * @param array     $data
	 * @param array     $where
	 * @param array     $add_fields 数据的每个子元素添加新的字段 ( 目前只在add数据时才有用, update无效 )
	 * @param bool      $is_update
	 * @param bool      $batch      是否批量操作 (update 目前不支持批量操作)
	 */
	protected function save($_model, $data, $where = NULL, $add_fields=array(), $is_update = FALSE, $batch = FALSE)
	{
	    $status = FALSE;
	    if ($is_update === FALSE) {
	        if ($batch === FALSE) {
	            if (!empty($add_fields)) {
	                $data = array_merge($data, $add_fields);
	            }
	            $status = $this->$_model->add($data);
	        } else {
	            if (!empty($add_fields)) {
	                // 为每个元素插入新的字段 例如在每个元素中加入 motorcade_id 和 对应的值
	                foreach ($data as $key => $item) {
	                    foreach ($add_fields as $name => $val) {
	                        $data[$key][$name] = $val;
	                    }
	                }
	            }
	            $status = $this->$_model->add_batch($data);
	        }
	    } else {
	        $status = $this->$_model->update($data, $where);
	    }
	
	    return $status;
	}
    /**
     * 检测司机在订单时间是不是在休假
     */
    protected function check_driver_is_off($drver_user_id, $start_time, $end_time,  $start_time1 = '', $end_time1 = ''){
        $driver_is_off = 0;
        if(empty($drver_user_id) || empty($start_time) || empty($end_time)){
            return $driver_is_off;
        }
        $start_time = date('Y-m-d 00:00:00', $start_time);
        $end_time = date('Y-m-d 00:00:00', $end_time);
        //以订单维度来处理
        $where_car_off = "driver_user_id =".$drver_user_id." and (
		(off_start_time <= '".$start_time."' and '".$start_time."' <= off_end_time) or
		(off_start_time <= '".$end_time."' and '".$end_time."' <= off_end_time) or
		('".$start_time."' <= off_start_time and off_end_time <='".$end_time."')
		)";
        if(!empty($start_time1) || !empty($end_time1)){
            $start_time1 = date('Y-m-d 00:00:00', $start_time1);
            $end_time1 = date('Y-m-d 00:00:00', $end_time1);
            $where_car_off = "driver_user_id =".$drver_user_id." and (
			((off_start_time <= '".$start_time."' and '".$start_time."' <= off_end_time) or
		(off_start_time <= '".$end_time."' and '".$end_time."' <= off_end_time) or
		('".$start_time."' <= off_start_time and off_end_time <='".$end_time."')
		) or
		((off_start_time <= '".$start_time1."' and '".$start_time1."' <= off_end_time) or
		(off_start_time <= '".$end_time1."' and '".$end_time1."' <= off_end_time) or
		('".$start_time."' <= off_start_time and off_end_time <='".$end_time."')
		))";
        } 
        $this->load->model('M_driver_off');
        $off = $this->M_driver_off->get_one($where_car_off);
        if(!empty($off)){
            $driver_is_off = 1;
        }
        return $driver_is_off;
    }
    /**
     * 检测车辆是不是在维修或者年检
     */
    protected function check_car_is_repair($vehicle_id, $start_time, $end_time,  $start_time1 = '', $end_time1 = ''){
        $car_is_repair = 0;
        if(empty($vehicle_id) || empty($start_time) || empty($end_time)){
            return $car_is_repair;
        }
        $this->load->model('M_vehicle_repair_info');
        $this->load->model('M_vehicle_year_check_info');
        $this->load->model('M_arrange_car_time');
        //检测该订单区间是不是空闲
        $car_is_free = $this->M_arrange_car_time->find_car_is_free($vehicle_id, $start_time, $end_time,  $start_time1, $end_time1);
        if($car_is_free == 1){
            $car_is_repair = 1;
            return $car_is_repair;
        }
        $start_time = date('Y-m-d H:i:s', $start_time);
        $end_time = date('Y-m-d H:i:s', $end_time);
        //车辆是否维修
        $where = "vehicle_id =".$vehicle_id." and (
		(repair_time <= '".$start_time."' and '".$start_time."' <= get_car_time) or
		(repair_time <= '".$end_time."' and '".$end_time."' <= get_car_time) or
		('".$end_time."' <= repair_time and  get_car_time <= '".$end_time."') or
		('".$start_time."' <= repair_time and  get_car_time <= '".$end_time."')
		)";
        if(!empty($start_time1) || !empty($end_time1)){
            $start_time1 = date('Y-m-d H:i:s', $start_time1);
            $end_time1 = date('Y-m-d H:i:s', $end_time1);
            $where = "vehicle_id =".$vehicle_id." and (
			((repair_time <= '".$start_time."' and '".$start_time."' <= get_car_time) or
		(repair_time <= '".$end_time."' and '".$end_time."' <= get_car_time) or
		('".$end_time."' <= repair_time and  get_car_time <= '".$end_time."')) or
		(repair_time <= '".$start_time1."' and '".$start_time1."' <= get_car_time) or
		(repair_time <= '".$end_time1."' and '".$end_time1."' <= get_car_time) or
		('".$end_time1."' <= repair_time and  get_car_time <= '".$end_time1."')
		or ('".$start_time1."' <= repair_time and  get_car_time <= '".$end_time1."')
		)";
        }
        $repair = $this->M_vehicle_repair_info->get_one($where);
        if(!empty($repair)){
            $car_is_repair = 1;
            return $car_is_repair;
        }
        //车辆是否年检
        $where_year = "vehicle_id =".$vehicle_id." and (
		(check_time <= '".$start_time."' and '".$start_time."' <= get_car_time) or
		(check_time <= '".$end_time."' and '".$end_time."' <= get_car_time) or
		('".$end_time."' <= check_time and  get_car_time <= '".$end_time."') or
		('".$start_time."' <= check_time and  get_car_time <= '".$end_time."')
		)";
        if(!empty($start_time1) || !empty($end_time1)){
            $where_year = "vehicle_id =".$vehicle_id." and (
			((check_time <= '".$start_time."' and '".$start_time."' <= get_car_time) or
		(check_time <= '".$end_time."' and '".$end_time."' <= get_car_time) or
		('".$end_time."' <= check_time and  get_car_time <= '".$end_time."')) or
		('".$start_time."' <= check_time and  get_car_time <= '".$end_time."') or
		(check_time <= '".$start_time1."' and '".$start_time1."' <= get_car_time) or
		(check_time <= '".$end_time1."' and '".$end_time1."' <= get_car_time) or
		('".$end_time1."' <= check_time and  get_car_time <= '".$end_time1."')
		or ('".$start_time."' <= check_time and  get_car_time <= '".$end_time."')
		)";
        }
        $year = $this->M_vehicle_year_check_info->get_one($where_year);
        if(!empty($year)){
            $car_is_repair = 1;
            return $car_is_repair;
        }
        return $car_is_repair;
    }
	
	//根据座位数判断车型是否在数据库中存在,否则插入
	protected function create_car_type($seat_num){
		//$_CI = &get_instance();
		$this->load->model('m_car_type_number');

		$car_info = $this->m_car_type_number->get_one("seat_num=$seat_num");
		if(empty($car_info)){ 
			if($seat_num>=5 && $seat_num<=19){
				$car_name = '商务'.$seat_num.'座';
			}
			elseif($seat_num>=20 && $seat_num<=39){
				$car_name = '中巴'.$seat_num.'座';
			}
			elseif($seat_num>=40 && $seat_num<=80){
				$car_name = '大巴'.$seat_num.'座';
			}
			else{
				return false;
			}
			$data['car_name'] = $car_name;
			$data['seat_num'] = $seat_num;
			$car_type_id = $this->m_car_type_number->add($data);
			if($car_type_id == false){
				return false;
			}
			return $car_type_id;
		}
		else{
			return $car_info['car_type_id'];
		}
		
	}
}
