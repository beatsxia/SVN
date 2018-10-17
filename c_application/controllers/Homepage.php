<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Homepage extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');
        //引入函数
        $this->load->library('CI_User');
                            

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
		//获取首页轮播图信息
		$query=$this->db->query('SELECT * FROM  `ci_cc_rolling_ads` WHERE  `is_delete` =0 ORDER BY  `sort` ASC LIMIT 0 , 3');
		$list=$query->result_array();

        $rolling_content = $this->user_model->get_rolling_content('5');
        $rolling_content_arr = array();
        foreach ($rolling_content as $key => $value) {

            $inherit_user = $this->user_model->select_info('cc_user','nickname,avatar',array('id' => $this->user_model->select_info('cc_inherit','user_id',array('id' => $value['inh_id']))));
            $collect_array = $this->ci_user->user_inh_is_collect($value['inh_id'],$_SESSION['uid']);
            $value['collect_img'] = $collect_array['collect_img'];
            $value['nickname'] = $inherit_user['nickname'];
            $value['avatar']   = $inherit_user['avatar'];
			$value['article']  = $this->db->select("id,content")->from("cc_inherit_content") ->where(array("inh_id" => $value['inh_id'], "sort" => 1))->get()->row_array();
            $rolling_content_arr[] = $value;
        }
		
		$private_inherit = array();
		$uid = null;
		if(!empty($_SESSION['uid']))
		{
			$private_inherit = $this->db->select("id,title,picture")->from("cc_inherit")->where("user_id", $_SESSION['uid'])->get()->result_array();
			$uid = $_SESSION['uid'];
			
			foreach($private_inherit as $pk=>$pv)
			{	
				$collect_array = $this->ci_user->user_inh_is_collect($pv['id'],$_SESSION['uid']);
            	$private_inherit[$pk]['collect_img'] = $collect_array['collect_img'];
				$private_inherit[$pk]["article"] = $this->db->select("id,content")->from("cc_inherit_content") ->where(array("inh_id" => $pv['id'], "sort" => 1))->get()->row_array();
			}
		}
		//print_r($private_inherit);exit;
        $data = array('inc_url' => $inc_url, 'advertisement' => $list ,'rolling_content_arr' => $rolling_content_arr, 'private_inherit' => $private_inherit, 'uid' => $uid);
		$this->load->view('index',$data);
    }
}
?>