<?php
/**
 * 扩展CI的基础模型
 */
class Base_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 查询单条记录
     */
    public function get_one($where, $fields='*', $table_name)
    {
        if(empty($table_name)){
            return false;
        }
        return $this->db->select($fields)->where($where)->get($table_name)->row_array();
    }
    /**
     * 新增一条数据
     */
    public function add($data, $table_name)
    {
        if(empty($table_name)){
            return false;
        }
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }
    /**
     * 更新
     */
    public function update($data, $where, $table_name)
    {
        if(empty($table_name)){
            return false;
        }
        return $this->db->update($table_name, $data, $where);
    }
    /**
     * 删除
     */
    public function delete($where, $table_name){
        if (!empty($where) && !empty($table_name)) {
            return $this->db->delete($table_name, $where);
        }
        return false;
    }
    /**
     * 获取列表
     */
    public function get_list($where = '', $fields = '*', $table_name, $order = '')
    {
        if(empty($table_name)){
            return false;
        }
        $this->db->select($fields);
        if(!empty($where)){
            $this->db->where($where);
        }
        if(!empty($order)){
            $this->db->order_by($order);
        }
        $query = $this->db->get($table_name);
        return $query->result_array();
    }
    /**
     * 公用方法 联查
     *
     * @param array  $where
     * @param string $fields
     * @param int 	 $limit
     * @param int 	 $offset
     * @param array  $join
     *          |- string  table
     *          |- string  cond  关联条件
     *          |- string  type  联查方式 ep:'left, right inner'
     * 
     * @param order 
     * @param group
     * @param $alias 为主表设置别名
     * @return array
     */
    public function get_list_by_join($where=NULL, $fields='*',$limit=NULL, $offset=NULL, $join = NULL, $order=NULL, $group=NUll, $alias=NULL)
    {
        $this->db->select($fields);
        $table = $this->_tablename;
    
        if(!empty($where)){
            $this->db->where($where);
        }

        if($join !== NULL){
            $this->db->join($join['table'], $join['cond'], $join['type']);
        }
    
        if(!empty($order)){
            $this->db->order_by($order);
        }

        if(!empty($group)){
            $this->db->group_by($group);
        }

        $this->db->limit($limit, $offset);
        
        if (!empty($alias)) {
            $table .= ' as '.$alias;
        }
        
        $query = $this->db->get($table);
        // var_dump($this->db->last_query());
        return $query->result_array();
    }
    
    /**
     * 公用方法， 多表联查
     *
     * @param array  $where
     * @param string $fields
     * @param int 	 $limit
     * @param int 	 $offset
     * @param array  $join 二维关联数组
     *         array
     *          |- string  table
     *          |- string  cond  关联条件
     *          |- string  type  联查方式 ep:'left, right inner'
     * @param string $order
     * @param string $group
     * @param string $alias
     * 
     * @return array
     */
    public function get_list_by_multi_join($where=NULL, $fields='*',$limit=NULL, $offset=NULL, $join = NULL, $order=NULL, $group=NUll, $alias=NULL, $is_row = false)
    {
        $this->db->select($fields);
        $table = $this->_tablename;
    
        if(!empty($where)){
            $this->db->where($where);
        }
             
        if($join !== NULL) {
            foreach ($join as $val) {
                $this->db->join($val['table'], $val['cond'], $val['type']);
            }
        }
        
        if (!empty($alias)) {
            $table .= ' as '.$alias;
        }
        if(!empty($order)){
            $this->db->order_by($order);
        }
        if(!empty($group)){
            $this->db->group_by($group);
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get($table);
        $result = $is_row ? $query->row_array() : $query->result_array();
        // var_dump($this->db->last_query());
        return $result;
    }
    
    /* 多联查获取单个  */
    public function get_one_by_multi_join($where=NULL, $fields='*',$join = NULL, $order=NULL, $group=NUll, $alias=NULL)
    {
        $res = $this->get_list_by_multi_join($where, $fields, 1, 0, $join, $order, $group, $alias);
        return $res[0];
    }
    /* 单联查获取单个  */
    public function get_one_by_join($where=NULL, $fields='*',$join = NULL, $order=NULL, $group=NUll, $alias=NULL)
    {
        $res = $this->get_list_by_join($where, $fields, 1, 0, $join, $order, $group, $alias);
        return $res[0];
    }

    /**
     *
     * 删除数据库表中数据，物理删除（使用谨慎）
     * @param $where
     * @param array $tables
     * @return bool
     */
    public function del_data($where, $tables = array()){
        if(empty($where)){
            return false;
        }
        if(empty($tables)){
            $tables = $this->_tablename;
        }
        $this->db->where($where);
        return $this->db->delete($tables);
    }
}
