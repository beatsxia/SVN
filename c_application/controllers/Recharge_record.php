<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Recharge_record extends CI_Controller {
    
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
		
        //获取充值记录
        $select_recharge_record = $this->user_model->select_recharge_record($uid);
        $data = array('inc_url' => $inc_url,'select_recharge_record' => $select_recharge_record);
		$this->load->view('recharge_record',$data);
    }
    
}
?>