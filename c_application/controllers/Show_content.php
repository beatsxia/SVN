<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Show_content extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        //用户ID
        $uid = $_SESSION['uid'];

        //获取传记id
        if(empty($this->input->get('cid'))){
            echo '没有传记ID';exit();
            
        }else{
            $cid = intval($this->input->get('cid'));
            $inh_content = $this->user_model->get_inherit_contents_byid($this->db->escape_str($this->input->get('cid')));
            $inh_id = $inh_content['inh_id'];
            //判断传记是否公开
            $is_open = $inh_content['is_open'];
            if($is_open == '0'){//不公开
                $power_id = $this->user_model->select_info('cc_inherit_power', 'id', array('inh_id' => $inh_id, 'user_id' => $uid));
                if(empty($power_id)){
                    echo "传记未公开";exit();
                }
            }
            $stele_id = $this->user_model->select_info('cc_inherit', 'stele_id', array('id' => $inh_id));
            if(in_array($uid, array($inh_content['user_id'], $inh_content['inh_user_id']))){
                $inh_content['is_power'] = '1';
            }else{
                $inh_content['is_power'] = '0';
            }
			$inh_content["content"] = json_decode($inh_content["content"], true);
			//留言
			$comment_num = $this->user_model->get_comment_num($inh_id);
			$comments = $this->user_model->get_inh_comment2($inh_id);
			$comments_data = array();
			foreach ($comments as $key => $value) {
				if($value['comment_id']!='0'){
					$value['comment_id_name'] = $this->user_model->select_info('cc_user', 'nickname', array('id' => $value['cc_user_id']));
				}else{
					$value['comment_id_name'] = '';
				}
				$value['sub']=$this->user_model->get_inh_comment2($inh_id,0,1,0,$value["id"]);
				$comments_data[] = $value;
			}
			//表情包
			$arcPath = "./include/arclist/";
			$arclist = scandir($arcPath);
			$imgtype = array(0 => "png", 1 => "gif", 2 => "jpg");
			foreach($arclist as $ik => $iv)
			{
				$extArr = explode(".",$iv);
				$len    = count($extArr);
				$ext    = $extArr[$len - 1];
				if(!in_array($ext, $imgtype))
				{
					unset($arclist[$ik]);
				}
			}
			//print_r($comments_data);exit;
            $data = array("inc_url" => $inc_url, "inh_content" => $inh_content, "stele_id" => $stele_id, "com_num" => $comment_num, "comment" => $comments_data, "arclist" => $arclist);
            $this->load->view('show_content',$data);
        }
    }
	
	public function ajaxMsg()
	{
		$result = array();
		if(empty($_SESSION['uid'])){
			$result["status"] = "error";
			$result["msg"]    = "请先登录";
    		$result = json_encode($result);
			echo $result;
			exit;
    	}
		$this->load->model('user_model');
		
		$type = intval($this->input->post('comment_type'));
		$cc_id = intval($this->input->post('comment_cc_id'));
		$user_id = $_SESSION['uid'];
		$user_info =  $this->user_model->select_info('cc_user', 'nickname,mobile,avatar', array('id' => $user_id));
		$user_name = $user_info['nickname'];
		$content = $this->input->post('msgdata');
		
		$time = time();
		$user_ip = (isset($_SERVER["HTTP_VIA"])) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"]; 
		$user_ip = ($user_ip) ? $user_ip : $_SERVER["REMOTE_ADDR"];
		$user_phone = $user_info['mobile'];

		if($type=='1'){
			$comment_id = intval($this->input->post('comment_father_id'));
			$cc_user_id = $this->user_model->select_info('cc_comment', 'user_id', array('id' => $comment_id));
		}else{
			$comment_id = '0';
			$cc_user_id = $this->user_model->select_info('cc_inherit', 'user_id', array('id' => $cc_id));
		}

		$comment_data = array('type' => $type, 'cc_id' => $cc_id, 'cc_user_id' => $cc_user_id, 'user_id' => $user_id, 'user_name' => $user_name, 'content' => $content, 'time' => $time, 'user_ip' => $user_ip, 'user_phone' => $user_phone, 'comment_id' => $comment_id);
		$com_id = $this->user_model->insert_cc_comment($comment_data);
		if($com_id){
			$result["status"] = "ok";
			$result["msg"]    = "发表成功";
			$result["id"]     = $com_id;
			$result["user_name"] = $user_name;
			$result["avatar"]    = $user_info['avatar'];
		}
		else
		{
			$result["status"] = "error";
			$result["msg"]    = "系统繁忙";
		}
		
		$result = json_encode($result);
		echo $result;
		exit;
	}
	public function ajaxGetMsg()
	{
		$result = array();
		$this->load->model('user_model');
		$inh_id = intval($this->input->post('inhId'));
		$inhNum = intval($this->input->post('num'));
		$page = intval($this->input->post('page'));
		
		$num     = $this->user_model->get_comment_num($inh_id);
		$moreOut = $num - $inhNum;
		
		$more    = $inhNum % 10;
		$pageLen = ($inhNum - $more) / 10;
		if($more > 0)
		{
			$pageLen += 1;
		}
		
		$comments    = $this->user_model->get_inh_comment2($inh_id,10,$page,$moreOut);
		$comments_data = array();
		foreach ($comments as $key => $value) {
			if($value['comment_id']!='0'){
				$value['comment_id_name'] = $this->user_model->select_info('cc_user', 'nickname', array('id' => $value['cc_user_id']));
			}else{
				$value['comment_id_name'] = '';
			}
			$value['sub']=$this->user_model->get_inh_comment2($inh_id,0,1,0,$value["id"]);
			$comments_data[] = $value;
		}
		$result["len"] = "ing";
		if(empty($comments_data))
		{
			$result["status"] = "error";
			$result["msg"]    = "系统繁忙";
		}
		else
		{
			$result["status"] = "ok";
			$result["msg"]    = "加载完成";
			$result["data"]   = $comments_data;
		}
		if($pageLen == $page)
		{
			$result["len"] = "end";
			$result["msg"] = "留言已全部加载完毕";
		}
		$result = json_encode($result);
		echo $result;
		exit;
	}
}
?>