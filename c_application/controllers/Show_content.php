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
            $data = array('inc_url' => $inc_url, 'inh_content' => $inh_content, 'stele_id' => $stele_id);
            $this->load->view('show_content',$data);
            
        }
    }
}
?>