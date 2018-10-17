<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mountain extends CI_Controller {
    
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
		$query = $this->db->query('SELECT id,title,synopsis,picture,gift_type,style,is_ste_open FROM  `ci_cc_stele` WHERE `is_del`=0 AND `id` =' . $id);
		$list  = $query->row_array();
		/*$query=$this->db->query('SELECT * FROM  `ci_family_genealogy` WHERE  `id` =' . $id);
		$list=$query->row_array();*/
		if(empty($list))
		{
			$this->load->view('error_view',array("msg" => "该祠主不存在"));
			return;
		}
		//用户信息
		$userid = 22;//$_SESSION['uid'];
		$userInfo = $this->db->select("stone")->from("cc_user")->where("id",$userid)->get()->row_array();
		//获取动态
        $dyList = $this->user_model->getDynamic($id);
		
		//获取各山
		$hillList  = $this->db->select('a.id,a.name,a.level,a.price,a.sort,b.mid')->from('family_mountain a')->join('family_mountain_order b', 'b.mid=a.id and b.steleid=' . $id, 'left')->order_by('a.sort', 'ASC')->get()->result_array();
		
		//echo "<pre>";print_r($hillList);exit;
        $data = array('info' => $list, 'inc_url' => $inc_url, 'dynamic' => $dyList, 'hilllist' => $hillList, 'userinfo' => $userInfo);
		$this->load->view('mountain',$data);
    }
	
	/*激活风水山*/
	public function ajaxBuy()
	{
		$result = array();
		/*if(empty($_SESSION['uid'])){
			$result["status"] = "error";
			$result["msg"]    = "请先登录";
    		$result = json_encode($result);
			echo $result;
			exit;
    	}*/
		$userid = 22;//$_SESSION['uid']
		$steleid = intval($this->input->get("sid"));
		$id      = intval($this->input->get("hid"));
		
		$stele   = $this->db->select('id')->from('cc_stele')->where(array("id" => $steleid, "user_id" => $userid,"is_del" => 0))->get()->row_array();
		$hill    = $this->db->select('price,name,sort')->from('family_mountain')->where('id',$id)->get()->row_array();
		
		if( empty($stele) || empty($hill) )
		{
			$result["status"] = "error";
			$result["msg"]    = "只有建碑者有权利激活";
		}
		else
		{
			$order = $this->db->select('id')->from('family_mountain_order')->where('steleid=' . $steleid . ' and mid=' . $id)->get()->row_array();
			if(empty($order) && $hill["price"] != 0)
			{
				$userInfo = $this->db->select("stone")->from("cc_user")->where("id",$userid)->get()->row_array();
				if( $userInfo["stone"] < $hill["price"] )
				{
					$result["status"] = "error";
					$result["msg"]    = "您的灵石数量不足";
				}
				else
				{
					$this->db->update('cc_user', array('stone' => ($userInfo["stone"] - $hill["price"])), array("id" => $userid));
					$data = array("steleid" => $steleid, "mid" => $id);
					$re = $this->db->insert('family_mountain_order', $data);
					if($re)
					{
						$result["status"] = "ok";
						$result["msg"]    = "你成功激活了风水山【" . $hill['name'] . "】";
						$result["sort"]   = $hill['sort'];
					}
					else
					{
						$result["status"] = "error";
						$result["msg"]    = "系统繁忙";
					}
				}
			}
			else
			{
				$result["status"] = "error";
				$result["msg"]    = "您已激活该山脉";
			}
		}
		$str = json_encode($result);
		echo $str;exit;
		
	}
}
?>