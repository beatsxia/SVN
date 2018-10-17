<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tribute extends CI_Controller {
    
     public function index()
    {	
    	// if(empty($_SESSION['uid'])){
    		// redirect('WechatOauthLogin');exit();
    	// }
		$this->load->model('user_model');
    	$id = intval($this->input->get('id'));
		$inc_url = $this->user_model->get_picture_space_info('url');
		if(!$id || $id == 0)
		{
			$this->load->view('error_view',array("msg" => "该祠主不存在"));
			return;
		}
		
		$m_query=$this->db->query('SELECT `id` FROM  `ci_cc_stele` WHERE `is_del`=0 AND `id` =' . $id);
		$member=$m_query->row_array();
		if(empty($member))
		{
			$this->load->view('error_view',array("msg" => "该祠主不存在"));
			return;
		}
		$g_querry = $this->db->query('SELECT * FROM  `ci_tribute_group` WHERE `id`!=1 ORDER BY `sort` ASC');
		$groupList   = $g_querry->result_array();
		
		$querry = $this->db->query('SELECT * FROM  `ci_tribute` WHERE  `groupid` !=0 ORDER BY `sort` ASC');
		$list   = $querry->result_array();
		
        $data = array('group' => $groupList ,'list' => $list, 'member' => $member, 'inc_url' => $inc_url);
		$this->load->view('tribute',$data);
    }
	
	public function ajaxExchange()
	{
		$result  = array();
		/*if(empty($_SESSION['uid'])){
			$result["status"] = "error";
			$result["msg"]    = "请先登录";
    		$result = json_encode($result);
			echo $result;
			exit;
    	}*/
		
		$mid     = 22;
		$steleid = intval($this->input->get("sid"));
		$tid     = intval($this->input->get("id"));
		
		$s_query = $this->db->query('SELECT `id`,`title` FROM  `ci_cc_stele` WHERE `is_del`=0 AND `id` =' . $steleid);
		$sInfo   = $s_query->row_array();
		$tribute = array();
		if( $tid == 0 && intval($this->input->get("num")) > 0 && intval($this->input->get("num")) < 100)
		{
			$num              = intval($this->input->get("num"));
			$tribute['moral'] = "灵石x" . $num;
			$tribute['price'] = $num;
		}
		else
		{
			$query   = $this->db->query('SELECT `id`,`moral`,`price` FROM  `ci_tribute` WHERE  `id` =' . $tid);
			$tribute = $query->row_array();
		}
		
		if(empty($sInfo) || empty($tribute))
		{
			$result["status"] = "error";
			$result["msg"]    = "您操作的内容不存在";
		}
		else
		{
			$userInfo = $this->db->select("stone")->from("cc_user")->where("id",$mid)->get()->row_array();
			if( $userInfo["stone"] < $tribute["price"] )
			{
				$result["status"] = "error";
				$result["msg"]    = "您的灵石数量不足";
			}
			else
			{
				$this->db->update('cc_user', array('stone' => ($userInfo["stone"] - $tribute["price"])), array("id" => $mid));
			
				$data = array();
				$data["mid"]       = $mid;
				$data["steleid"]   = $steleid;
				$data["tributeid"] = $tid;
				$data["givetime"]  = time();
				$data["num"]       = isset($num) ? $num : 1;
				
				$re = $this->db->insert('family_dynamic', $data);
				if($re)
				{
					$result["status"] = "ok";
					$result["msg"]    = "您为" . $sInfo['title'] . "赠送了" . $tribute['moral'];
				}
				else
				{
					$result["status"] = "error";
					$result["msg"]    = "系统繁忙，请稍后重试";
				}
			}
			
		}
		
		$result = json_encode($result);
		echo $result;
		exit;
	}
}
?>