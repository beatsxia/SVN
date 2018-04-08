<?php 
class Decide_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function db_decide_inherit($user_id='0',$inh_id='0')
    {
    	$this->db->select('power_form');
        $this->db->from('cc_inherit_power');
        $this->db->where('user_id',$user_id);
        $this->db->where('inh_id',$inh_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    //根据note_id 查询留言用户
    public function db_decide_note($note_id='0')
    {
    	$this->db->select('user_id');
        $this->db->from('cc_note');
        $this->db->where('id',$note_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    
    public function db_decide_stele_connect($user_id='0',$stele_id='0')
    {
    	$this->db->select('note');
        $this->db->from('cc_stele_connect');
        $this->db->where('user_id',$user_id);
        $this->db->where('stele_id',$stele_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function db_decide_inherit_content($user_id='0',$inh_con_id='0')
    {
    	$this->db->select('cc_inherit_power.power_form');
        $this->db->from('cc_inherit_power');
        $this->db->join('cc_inherit_content', 'cc_inherit_content.inh_id = cc_inherit_power.inh_id','left');
        $this->db->where('cc_inherit_content.id',$inh_con_id);
        $this->db->where('cc_inherit_power.user_id',$user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
}