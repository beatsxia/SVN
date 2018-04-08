<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WechatOauthLogin extends CI_Controller {
    
     public function index()
    {	
    	$query=$this->db->query('SELECT * FROM  `ci_wechat_config` where id=1');
		$list=$query->row_array();
		$appid = $list['appid'];
		$redirect_uri = $list['redirect_uri'];
		
		$state = '123abc';
        header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state='.$state.'&connect_redirect=1#wechat_redirect');
    }

	public function user_info($str_value)
	{	
		
		$this->load->helper('auth');
		$this->load->helper('password');
		$auth = new wxauth();
		$wxuser_data = $auth->wxuser;
		$uniacid = '1';
		if($wxuser_data['open_id']){
			$open_id = $wxuser_data['open_id'];
			$query = $this->db->query("SELECT id FROM  `ci_cc_user` where open_id='$open_id'");
			$result = $query->row_array();
			$nowtime = time();
			if ($result) {//如果用户存在
				$uid = $result['id'];
				$data['user_token'] = $_SESSION['user_token'];
				$data['token_time'] = $_SESSION['token_time'];
				$where = array('uniacid' => $uniacid,'uid' => $uid);
				$this->db->update("wechat_token_time",$data,$where);//返回结果boolean;
			}elseif (empty($result)) {//如果没有该用户
				$data = array(
					'uniacid' => $uniacid,
				    'open_id' => $wxuser_data['open_id'],
				    'nickname' => $wxuser_data['nickname'],
				    'gender' => $wxuser_data['sex'],
				    'createtime' => $nowtime,
				    'province' => $wxuser_data['province'],
				    'city' => $wxuser_data['city'],
				    'country' => $wxuser_data['country'],
				    'avatar' => $wxuser_data['avatar']
				);
				$this->db->insert('wechat_member', $data);//新建用户数据wechat_member表
				$mid = $this->db->insert_id();
				$data = array(
					'uniacid' => $uniacid,
					'mid' => $mid,
				    'open_id' => $wxuser_data['open_id'],
				    'nickname' => $wxuser_data['nickname'],
				    'gender' => $wxuser_data['sex'],
				    'createtime' => $nowtime,
				    'location' => $wxuser_data['location'],
				    'province' => $wxuser_data['province'],
				    'city' => $wxuser_data['city'],
				    'country' => $wxuser_data['country'],
				    'avatar' => $wxuser_data['avatar']
				);
				$this->db->insert('cc_user', $data);//新建用户数据cc_user表
				$uid = $this->db->insert_id();
				$data = array(
				    'uniacid' => $uniacid,
				    'uid' => $uid,
				    'user_token' => $_SESSION['user_token'],
				    'token_time' => $_SESSION['token_time']
				);
				$this->db->insert('wechat_token_time', $data);//新建用户token_time
			}
			$_SESSION['uid']=$uid;
		}elseif(empty($wxuser_data['open_id'])){
			die('微信登录失败');
		}else{
			die('微信登录失败');
		}
		if(!empty($str_value)){
			switch ($str_value){

			    case "show_article":
			    	break;
			    case "root_new_set":
			    	$str_num = intval($this->input->get('inh_id'));
			    	if(!empty($str_num)){
			    		redirect('root_new_set?inh_id='.$str_num);
			    	}else{
			    		redirect('root_new_set');
			    	}
			        break;
			    case "cloud":
			    	$str_num = intval($this->input->get('s'));
			    	if(!empty($str_num)){
			    		redirect('cloud?s='.$str_num);
			    	}else{
			    		redirect('cloud');
			    	}
			        break;
			    case "memery":
			    	redirect('cloud/memery');
			        break;
			    default: 
			        redirect('homepage');
			        break;
			}
		}else{
			redirect('homepage');
		}
	}

	public function main($var_value)
    {	
    	$query=$this->db->query('SELECT * FROM  `ci_wechat_config` where id=1');
		$list=$query->row_array();
		$appid = $list['appid'];
		if(!empty($var_value)){
			switch ($var_value){
			    case "show_article":
			    	break;
			    case "cloud":
			    	$str_num = intval($this->input->get('s'));
			    	if(!empty($str_num)){
			    		$redirect_uri = $list['redirect_uri'].'/cloud?s='.$str_num;
			    	}else{
			    		$redirect_uri = $list['redirect_uri'];
			    	}
			        break;
			    case "root_new_set":
			    	$str_num = intval($this->input->get('inh_id'));
			    	if(!empty($str_num)){
			    		$redirect_uri = $list['redirect_uri'].'/root_new_set?inh_id='.$str_num;
			    	}else{
			    		$redirect_uri = $list['redirect_uri'];
			    	}
			        break;
			    case "memery":
			    	$redirect_uri = $list['redirect_uri'].'/memery';
			        break;
			    default: 
			        $redirect_uri = $list['redirect_uri'];
			        break;
			}
		}else{
			$redirect_uri = $list['redirect_uri'];
		}
		
		$state = '123abc';
        header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state='.$state.'&connect_redirect=1#wechat_redirect');
    }
}
?>