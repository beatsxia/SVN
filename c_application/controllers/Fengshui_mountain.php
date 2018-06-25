<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fengshui_mountain extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

		
        $data = array('inc_url' => $inc_url);
		$this->load->view('fengshui_mountain',$data);
    }

    
    
}
?>