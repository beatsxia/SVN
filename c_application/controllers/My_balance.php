<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_balance extends CI_Controller {
    
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
		
        //获取余额
        $get_user_point = $this->user_model->get_user_point($uid);
        $data = array('inc_url' => $inc_url,'get_user_point' => $get_user_point);
		$this->load->view('my_balance',$data);
    }
    
}
?>