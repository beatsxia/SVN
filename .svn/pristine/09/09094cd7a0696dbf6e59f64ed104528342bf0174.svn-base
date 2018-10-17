<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Visitor_num extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        $uid = $_SESSION['uid'];

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $data['inc_url']=$inc_url;

        $inh_access_log = $this->user_model->get_inh_access_log($uid);
        $inh_access_log_num = count($inh_access_log);
        $inh_access_log_totle = $this->user_model->get_count_inh_access_log($uid);

        $data = array('inc_url' => $inc_url, 'inh_access_log' => $inh_access_log, 'inh_access_log_num' => $inh_access_log_num, 'inh_access_log_totle' => $inh_access_log_totle);
		$this->load->view('visitor_num',$data);
    }
    
}
?>