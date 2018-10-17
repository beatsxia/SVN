<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_collection extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        //
        $this->load->library('CI_User');

        $user_id = $_SESSION['uid'];
        $page = 1;
        $limit = 12;
        $user_collection = $this->ci_user->user_collection($user_id,$page,$limit);

        $data = array('inc_url' => $inc_url, 'user_collection' => $user_collection);
		$this->load->view('my_collection',$data);
    }

    
    
}
?>