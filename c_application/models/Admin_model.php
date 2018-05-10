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
        $this->db->from('user');
        $this->db->where('user_name',$user_name);
        $this->db->where('password',$password);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    //查询用户的密码salt字段  通过用户名
    public function db_admin_salt_by_name($user_name='0',$password='0')
    {
        $this->db->select('salt');
        $this->db->from('user');
        $this->db->where('user_name',$user_name);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row()->salt;
    }

    
}