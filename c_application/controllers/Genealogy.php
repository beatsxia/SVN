<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Genealogy extends CI_Controller {
    
     public function index()
    {	
    	// if(empty($_SESSION['uid'])){
    		// redirect('WechatOauthLogin');exit();
    	// }
    	$id = intval($this->input->get('id'));
		if(!$id || $id == 0)
		{
			$this->load->view('error_view',array("msg" => "查询不到家谱信息"));
			return;
		}
		$query=$this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `steleid`=' . $id);
		$list=$query->row_array();
		
		if(empty($list))
		{
			$this->load->view('error_view',array("msg" => "查询不到家谱信息"));
			return;
		}
		
		//获取双亲信息
		if($list["fatherid"] && $list["fatherid"] !== 0)
		{
			$f_query        = $this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `id` =' . $list["fatherid"]);
			$list["father"] = $f_query->row_array();
		}
		if($list["fatherid"] && $list["motherid"] !== 0)
		{
			$m_query        = $this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `id` =' . $list["motherid"]);
			$list["mother"] = $m_query->row_array();
		}
		//获取配偶
		$s_query        = $this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `spouseid` in(' . $list["spouseid"] .')');
		$list["spouse"] = $s_query->result_array();
		
		//获取子孙
		$sex = array(0 => "fatherid", 1 => "motherid");
		$son_query     = $this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `' . $sex[$list["sex"]] . '` =' . $id);
		$list["son"]   = $son_query->result_array();
		//对子孙分类
		$list["sonGroup"] = array();
		if(!empty($list["spouse"]) && !empty($list["son"]))
		{
			foreach($list["spouse"] as $sKey => $sVal)
			{
				foreach($list["son"] as $sonKey => $sonVal)
				{
					if($sonVal[$sex[$list["sex"]]] == $sVal["id"])
					{
						$list["sonGroup"][$sKey] = $sonVal;
					}
				}
			}
		}
		
        $data = array('info' => $list);
		$this->load->view('genealogy',$data);
    }
}
?>