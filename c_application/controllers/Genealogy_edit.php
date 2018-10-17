<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Genealogy_edit extends CI_Controller {
    
     public function index()
    {	
    	// if(empty($_SESSION['uid'])){
    		// redirect('WechatOauthLogin');exit();
    	// }
    	$id = intval($this->input->get('id'));
		
		$query=$this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `id` =' . $id);
		$list=$query->row_array();
		//获取双亲信息
		if($list["fatherid"] !== 0)
		{
			$f_query           =$this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `id` =' . $list["fatherid"]);
			$list["father"] = $f_query->row_array();
		}
		if($list["motherid"] !== 0)
		{
			$m_query           =$this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `id` =' . $list["motherid"]);
			$list["mother"] = $m_query->row_array();
		}
		
		//获取子孙
		$sex = array(0 => "fatherid", 1 => "motherid");
		$s_query     =$this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `' . $sex[$list["sex"]] . '` =' . $id);
		$list["son"] = $s_query->result_array();
		
        $data = array('info' => $list);
		$this->load->view('genealogy_edit',$data);
    }
}
?>