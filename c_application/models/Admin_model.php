<?php 
class Admin_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    //查询是否有该用户  通过用户名
    public function db_admin_login_by_name($user_name='0',$password='0')
    {
    	$this->db->select('id');
        $this->db->from('cc_user');
        $this->db->where('username',$user_name);
        $this->db->where('password',$password);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    //存储用户
    

    
}