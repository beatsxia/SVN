<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_biogrophy extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        
        $uid = $_SESSION['uid'];
		//我的传记
        $my_inherit = $this->user_model->select_user_inherit($uid,array('0','1'),'1');


        $data = array('inc_url' => $inc_url,'my_inherit' => $my_inherit);
		$this->load->view('my_biogrophy',$data);
    }

    
    
}
?>