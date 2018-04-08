<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Heritage_monument extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        //获取传承碑信息
        $stele = $this->user_model->get_stele_list(1,$_SESSION['uid']);
        $data = array('inc_url' => $inc_url, 'stele' => $stele);
		$this->load->view('heritage_monument',$data);
    }

    
    
}
?>