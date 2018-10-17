<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reply_me extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
        $uid = $_SESSION['uid'];
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $data['inc_url']=$inc_url;
        //获取前十条回复
        $comment_data = $this->user_model->get_user_comment_ten($uid);
        $data['comment_data'] = $comment_data;

		$this->load->view('reply_me',$data);
    }
    
}
?>